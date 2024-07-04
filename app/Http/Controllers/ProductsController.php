<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use Exception;

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

    public function newProduct () {

        try{
            DB::beginTransaction();

            $registro = new Product();
            $registro->name = 'Galaxy S22 ULTRA';
            $registro->description = '---';
            $registro->quantity = 20;
            $registro->category_id = 4;
           
            if( $registro->save()) {                
                DB::commit();
                return response()->json(['message' => 'Transaccion registrada con exito']);
            }
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message' => 'Fallo de registro revirtiendo cambios...']);
        }
    }

}
