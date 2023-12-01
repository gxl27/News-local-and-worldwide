<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    // resorces
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'categories' => $categories,
        ]);
    }
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'link' => 'required',
        ]);
        $category = Category::create($data);

        return response()->json([
            'message' => 'Category created successfully.',
            'category' => $category,
        ]);
    }
    public function edit(Category $category)
    {
        return response()->json([
            'category' => $category,
        ]);
    }
    public function update(Category $category)
    {
        $data = request()->validate([
            'name' => 'required',
            'link' => 'required',
        ]);
        $category->update($data);

        return response()->json([
            'message' => 'Category updated successfully.',
            'category' => $category,
        ]);
    }
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully.',
        ]);
    }
    
}
