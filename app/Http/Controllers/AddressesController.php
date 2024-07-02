<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addresses;
use App\Models\clients;

class AddressesController extends Controller
{
    public function view () {
        return view ('cruds.addresses');
    }

    public function show(Request $request)
    {
        $userName = $request->input('user_name');

        $results = proyectolaravel::table('addresses')
            ->join('clients', 'addresses.client_id', '=', 'clients.id')
            ->when($userName, function ($query, $userName) {
                return $query->where('clients.user_name', $userName);
            })
            ->select(
                'addresses.street as STREET',
                'addresses.number_ext as NUMBER_EXT',
                'addresses.zip_code as ZIP_CODE',
                'addresses.city as CITY',
                'addresses.country as COUNTRY',
                'addresses.principal as PRINCIPAL?'
            )
            ->get();

        return view('.addresses.show', compact('results'));
    }
}   
