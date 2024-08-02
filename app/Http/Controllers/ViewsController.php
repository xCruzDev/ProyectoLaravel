<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function inicioView(){
        return view('inicio');
    }

    public function contactView(){
        return view('contact');
    }

    public function columnView() {
        return view('column');
    }

    public function jsonView() {
        return view('json');
    }

    public function alumnoRegView() {
        return view('alumnoReg');
    }

    public function mainDashboardView() {
        return view('mainDashboard');
    }

    // // // // // // // // // // // // //

    public function productsView() {
        return view('CRUDS.products');
    }

    public function categoriesView() {
        return view('CRUDS.categories');
    }

    
}
