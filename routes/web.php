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
    return view('Login');
});

Route::get('/inicio',[ViewsController::class,'inicioView']);
Route::get('/contacto',[ViewsController::class,'contactView']);
Route::get('/column',[ViewsController::class,'columnView']);
Route::get('/json',[ViewsController::class,'jsonView']);
Route::get('/alumnoReg',[ViewsController::class,'alumnoRegView']);
Route::get('/mainDashboard',[ViewsController::class,'mainDashboardView']);

Route::get('/products',[ProductsController::class,'index']);
Route::get('/categories',[CategoriesController::class,'index']);

Route::get('/clients',[ClientsController::class,'index']);  /*ruta para las mostrar/consultar la tabla*/
Route::get('/get-clients/{id}',[ClientsController::class,'show']);

Route::get('/addresses',[AddressesController::class,'view']);
Route::get('/addresses/show{request}',[AddressesController::class,'show']);

Route::get('/tblusers',[TblUsersController::class,'index']);
Route::get('/get-tblusers/{id}',[TblUsersController::class,'show']);

