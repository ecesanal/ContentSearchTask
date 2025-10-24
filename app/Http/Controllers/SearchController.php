<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $lang = $request->input('lang');
        $results = [];

        if ($query && $lang) {
            $results = Content::where('language_id', $lang)
                ->where(function($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('content', 'like', "%{$query}%");
                })
                ->get();
        } elseif ($lang) {
            $results = Content::where('language_id', $lang)->get();
        }

        return view('search', compact('results', 'query', 'lang'));
    }
}
