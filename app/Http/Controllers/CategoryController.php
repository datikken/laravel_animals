<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategory($kind)
    {
        $category = Category::where('kind', $kind)->get();
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category does not exist'
            ]);
        }

        return response()->json(new CategoryCollection($category));
    }

    public function getCategories()
    {
        return response()->json(new CategoryCollection(Category::all()));
    }
}
