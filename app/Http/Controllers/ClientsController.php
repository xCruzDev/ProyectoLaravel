<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clients;

class ClientsController extends Controller
{

    public function index(){

        $clients = clients::All();
        return view('cruds.clients', compact ('clients'));
    }

    public function show ($id){

        $client = clients::find($id);

        if ($client) {
            return response()->json($client);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
