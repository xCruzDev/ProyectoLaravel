<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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

    public function newCategory () {

        try{
            DB::beginTransaction();

            $registro = new Category();
            $registro->description = 'SmartPhones';
            $registro->save();

            DB::commit();
            return response()->json(['message' => 'Transaccion registrada con exito']);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json(['message' => 'Fallo de registro revirtiendo cambios...']);
        }
    }
}
