<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(){

        $products = Product::With('categories') -> get();
        return view('cruds.products', compact ('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

}
