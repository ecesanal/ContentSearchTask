<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Content;
use App\Models\Language;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = [
                'email'    => $request->input('email'),
                'password' => $request->input('password'),
            ];

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->is_admin == 1) {
                    return redirect()->route('admin.dashboard');
                }
                Auth::logout();
                return back()->with('error', 'Bu alana sadece admin kullanıcılar girebilir.');
            }
            return back()->with('error', 'Geçersiz giriş bilgileri.');
        }

        return view('admin.login');
    }

    // Dashboard: SADECE admin
    public function dashboard()
    {
        $user = Auth::user();
        if (!$user || $user->is_admin != 1) {
            return redirect()->route('admin.login')->with('error', 'Bu alana sadece admin kullanıcılar erişebilir.');
        }

        $contents = Content::with(['language', 'user'])->latest('id')->get();
        return view('admin.dashboard', compact('contents'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Başarıyla çıkış yaptınız.');
    }

    public function editContent($id)
    {
        $user = Auth::user();
        if (!$user || $user->is_admin != 1) {
            return redirect()->route('admin.login')->with('error', 'Yetkiniz yok.');
        }

        $content   = Content::findOrFail($id);
        $languages = Language::orderBy('name')->get();
        return view('admin.edit', compact('content', 'languages'));
    }

    public function updateContent(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->is_admin != 1) {
            return redirect()->route('admin.login')->with('error', 'Yetkiniz yok.');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'language_id' => 'required|exists:languages,id',
        ]);

        $content = Content::findOrFail($id);
        $content->title       = $request->title;
        $content->content     = $request->content;
        $content->language_id = $request->language_id;
        $content->save();

        return redirect()->route('admin.dashboard')->with('success', 'İçerik güncellendi.');
    }

    public function deleteContent($id)
    {
        $user = Auth::user();
        if (!$user || $user->is_admin != 1) {
            return redirect()->route('admin.login')->with('error', 'Yetkiniz yok.');
        }

        $content = Content::findOrFail($id);
        $content->delete();

        return redirect()->route('admin.dashboard')->with('success', 'İçerik silindi.');
    }
}
