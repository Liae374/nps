<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function create()
    {
        $client = \App\Models\Client::where('IDclient', '=', request('ID'))->first();
        if ($client !== null) {
            return response('', 400);
        } else {
            $client = new \App\Models\Client;
            $client->IDclient = request('ID');
            $client->save();
            return response($client);
        }
    }

    public function read()
    {
        $client = \App\Models\Client::where('IDclient', '=', request('ID'))->first();
        if ($client == null) {
            return response('', 404);
        } else {
            return response($client, 200);
        }
    }

    public function readAll()
    {
        $clients = \App\Models\Client::All();
        if ($clients == null) {
            return response('', 404);
        } else {
            return response($clients, 200);
        }
    }

    public function delete()
    {
        $client = \App\Models\Client::where('IDclient', '=', request('ID'))->first();
        if (empty($client)) {
            return response('', 404);
        } else {
            $client->delete();
            return response('', 200);
        }
    }
}
