<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use Exception;


class CategoriesController extends Controller
{
    public function view(){

        return view('CRUDS.categories');
    }

    public function index() {
        $categories = Category::All();
        return response()->json($categories);
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

    public function newCategory (Request $request) {

        try{
            DB::beginTransaction();

            $registro = new Category();
            $registro->description = $request->description;

            if($registro->save()){
                DB::commit();
                return redirect('/categories');
            }

        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json(['message' => 'Fallo de registro revirtiendo cambios...']);
        }
    }

    public function updateCategory(Request $request) {
        $data = $request;
        Category::where('id', $request->id)
        ->update([
            'description' => $request->description,
        ]);

        return redirect('/categories');
    }

    public function destroyCategory($id) {
        try{
            DB::beginTransaction();
            $category = Category::findOrFail($id);

            if($category->delete()){
                DB::commit();
                return redirect('/categories');
            }

        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['message' => 'Fallo de transaccion revirtiendo cambios...']);
        }
    }
}
