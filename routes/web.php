<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\TblUsersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AddressesController;
 

Route::get('/', function () {
    return view('inicio');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/classes', function () {
    return view('clases');
});

Route::get('/dinamicJSON', function () {
    return view('dinamicJSON');
});

Route::get('/inicio',[ViewsController::class,'inicioView']);
Route::get('/contacto',[ViewsController::class,'contactView']);
Route::get('/column',[ViewsController::class,'columnView']);
Route::get('/json',[ViewsController::class,'jsonView']);
Route::get('/alumnoReg',[ViewsController::class,'alumnoRegView']);
Route::get('/mainDashboard',[ViewsController::class,'mainDashboardView']);




Route::get('/products',[ProductsController::class,'view']); // vista
Route::get('/products/get',[ProductsController::class,'index']); // obtener datos
Route::get('/products/get/{id}',[ProductsController::class,'show']); // obtener datos especifico ID
Route::post('/products/new',[ProductsController::class,'newProduct']); // registrar datos
Route::post('/products/update/',[ProductsController::class,'updateProduct']); // actualizar dato/s
Route::get('/products/delete/{id}',[ProductsController::class,'destroyProduct']); // eliminar datos

Route::get('/products/search/{name}',[ProductsController::class,'searchProduct']);
Route::get('/products/filter/product/ASC',[ProductsController::class,'productsASC']);
Route::get('/products/filter/product/DESC',[ProductsController::class,'productsDESC']);
Route::get('/products/filter/quantity/ASC',[ProductsController::class,'quantASC']);
Route::get('/products/filter/quantity/DESC',[ProductsController::class,'quantDESC']);




Route::get('/categories',[CategoriesController::class,'view']);
Route::get('/categories/get',[CategoriesController::class,'index']);




Route::get('/clients',[ClientsController::class,'index']);
Route::get('/clients/insert',[ClientsController::class,'store']);  /*ruta para las mostrar/consultar la tabla*/
Route::get('/get-clients/{id}',[ClientsController::class,'show']);

Route::get('/addresses',[AddressesController::class,'view']);
Route::get('/addresses/show{request}',[AddressesController::class,'show']);

Route::get('/tblusers',[TblUsersController::class,'index']);
Route::get('/get-tblusers/{id}',[TblUsersController::class,'show']);

