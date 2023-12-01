<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    // resorces
    public function index()
    {
        $news = News::all();

        return response()->json([
            'news' => $news,
        ]);
    }
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'link' => 'required',
        ]);
        $news = News::create($data);

        return response()->json([
            'message' => 'News created successfully.',
            'news' => $news,
        ]);
    }
    public function edit(News $news)
    {
        return response()->json([
            'news' => $news,
        ]);
    }
    public function update(News $news)
    {
        $data = request()->validate([
            'name' => 'required',
            'link' => 'required',
        ]);
        $news->update($data);

        return response()->json([
            'message' => 'News updated successfully.',
            'news' => $news,
        ]);
    }
    public function destroy(News $news)
    {
        $news->delete();

        return response()->json([
            'message' => 'News deleted successfully.',
        ]);
    }
    
}
