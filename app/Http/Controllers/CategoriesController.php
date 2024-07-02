<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoriesController extends Controller
{
    public function index(){

        $categories = Category::All();
        return view('cruds.categories', compact ('categories'));
    }

    public function show($id)
    {
        $category = Category::find($id);

        if ($category) {
            return response()->json($category);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
