<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblUsers; /* enlaza la tabla */

class TblUsersController extends Controller /* dentro coloca las funciones de CRUD*/
{

    public function index(){

        $tblusers = tblUsers::All();
        return view('cruds.tblusers', compact ('tblusers'));
    }

    public function show($idx)
    {
        $user = tblUsers::find($idx);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
