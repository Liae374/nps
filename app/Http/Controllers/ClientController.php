<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function client() 
    {
        return view('client', [
            'id' => request('id')
        ]);
    }

    public function thanks()
    {
        return view('thanks', [
            'id' => request('id'),
            'rating' => request('rating')
        ]);
    }

    public function authentication()
    {
        return view('authentication', []);
    }
}
