<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Language;

class SearchController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('search', compact('languages'));
    }

    public function search(Request $request)
    {
        $query = trim($request->input('q'));
        $langId = $request->input('lang');
        $languages = Language::all();
        $results = collect();

        if ($langId && $query !== '') {
            $results = Content::where('language_id', $langId)
                ->where(function ($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('content', 'LIKE', "%{$query}%");
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('search', compact('results', 'query', 'languages', 'langId'));
    }
}
