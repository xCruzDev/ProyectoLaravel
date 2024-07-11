<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use Exception;

class ProductsController extends Controller
{
    public function view(){
        return view('cruds.products');
    }

    public function index() {
        $products = Product::with('categories:id,description')->get();
        return response()->json($products);
    }

    public function productsASC() {
        $products = Product::with('categories:id,description')
                            ->orderBy('name','ASC')
                            ->get();
        return response()->json($products);
    }

    public function productsDESC() {
        $products = Product::with('categories:id,description')
                            ->orderBy('name','DESC')
                            ->get();
        return response()->json($products);
    }

    public function quantASC() {
        $products = Product::with('categories:id,description')
                            ->orderBy('quantity','ASC')
                            ->get();
        return response()->json($products);
    }

    public function quantDESC() {
        $products = Product::with('categories:id,description')
                            ->orderBy('quantity','DESC')
                            ->get();
        return response()->json($products);
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

    public function searchProduct($name){
        $result = Product::with('categories:id,description')
                ->where('name', 'like',$name . '%')
                ->get();
    return response()->json($result);
    }

    public function newProduct (Request $request) {

        try{
            DB::beginTransaction();
            
            $registro = new Product();
            $registro->name = $request->name;
            $registro->description = $request->description;
            $registro->price = $request->price;
            $registro->quantity = $request->quantity;
            $registro->category_id = $request->category_id;
           
            if( $registro->save()) {                
                DB::commit();
                return redirect('/products');
            }
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message' => 'Fallo de registro revirtiendo cambios...']);
        }
    }

    public function updateProduct(Request $request){
        $data = $request;
        Product::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        return redirect('/products');
    }

    public function destroyProduct($id) {
        
        try{
            DB::beginTransaction();
            $product = Product::findOrFail($id);

            if($product->delete()){
                DB::commit();
                return redirect('/products');
            }

        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['message' => 'Fallo de transaccion revirtiendo cambios...']);
        }
    }

}
