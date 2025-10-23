<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class ContentController extends Controller
{
  
    public function search(Request $request)
    {
        $languages = Language::all();
        $contents = [];

        if ($request->filled('query')) {
            $contents = Content::where('language_id', $request->language_id)
                ->whereFullText(['title', 'content'], $request->query)
                ->get();
        }

        return view('search', compact('languages', 'contents'));
    }
}
