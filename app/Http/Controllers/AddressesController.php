<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addresses;
use App\Models\clients;
use Illuminate\Support\Facades\DB;


class AddressesController extends Controller
{
    public function view () {
        return view ('cruds.addresses');
    }

    public function show($userName)
    {

        $results = DB::table('addresses')
            ->join('clients', 'addresses.client_id', '=', 'clients.id')
            ->when($userName, function ($query, $userName) {
                return $query->where('clients.user_name', $userName);
            })
            ->select(
                'addresses.street',
                'addresses.number_ext',
                'addresses.zip_code',
                'addresses.city',
                'addresses.country',
                'addresses.principal'
            )
            ->get();

        return response()->json($results);
    }
}   
