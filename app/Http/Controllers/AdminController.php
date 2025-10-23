<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Content;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = [
                'email' => $request->username,
                'password' => $request->password
            ];

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->is_admin == 1) {
                    return redirect()->route('admin.dashboard');
                } else {
                    Auth::logout();
                    return back()->with('error', 'Sadece admin kullanıcılar girebilir.');
                }
            } else {
                return back()->with('error', 'Geçersiz giriş bilgileri.');
            }
        }

        return view('admin.login');
    }

    public function dashboard()
    {
        $contents = Content::with('user')->get();
        return view('admin.dashboard', compact('contents'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Çıkış yapıldı.');
    }

    public function editContent($id)
    {
        $content = Content::findOrFail($id);
        return view('admin.edit', compact('content'));
    }

    public function updateContent(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $content->title = $request->title;
        $content->content = $request->content;
        $content->save();

        return redirect()->route('admin.dashboard')->with('success', 'İçerik güncellendi.');
    }

    public function deleteContent($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();

        return redirect()->route('admin.dashboard')->with('success', 'İçerik silindi.');
    }
}
