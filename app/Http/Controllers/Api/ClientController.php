<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @OA\Post(
     *      path="/client/{ID}",
     *      operationId="create",
     *      tags={"Client"},
     *      summary="Add new client",
     *      description="Ajoute un nouveau client. La variable ID repésente son identifiant.",
     *      
     *      @OA\Parameter(
     *          name="ID",
     *          in="path",
     *          description="Identifiant du nouveau client",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\MediaType(
     *            mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Wrong value"
     *      )
     * )
     */
    public function create()
    {
        $client = \App\Models\Client::where('IDclient', '=', request('ID'))->first();
        if ($client !== null) {
            return response(['error' => 'Client already exists'], 400);
        } else {
            $client = new \App\Models\Client;
            $client->IDclient = request('ID');
            $client->save();
            return response($client, 201);
        }
    }

    /**
     * @OA\Get(
     *      path="/client/{ID}",
     *      operationId="read",
     *      tags={"Client"},
     *      summary="Read client",
     *      description="Retourne un client. La variable ID repésente l'identifiant du client concerné.",
     *      
     *      @OA\Parameter(
     *          name="ID",
     *          in="path",
     *          description="Identifiant du client",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *            mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      )
     * )
     */
    public function read()
    {
        $client = \App\Models\Client::where('IDclient', '=', request('ID'))->first();
        if ($client == null) {
            return response(['error' => 'Client not found'], 404);
        } else {
            return response($client, 200);
        }
    }

    /**
     * @OA\Get(
     *      path="/client",
     *      operationId="readAll",
     *      tags={"Client"},
     *      summary="Read all clients",
     *      description="Retourne tous les clients contenus dans la base de donnée.",
     *      
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *            mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      )
     * )
     */
    public function readAll()
    {
        $clients = \App\Models\Client::All();
        if ($clients == null) {
            return response('', 404);
        } else {
            return response($clients, 200);
        }
    }

    /**
     * @OA\Delete(
     *      path="/client/{ID}",
     *      operationId="delete",
     *      tags={"Client"},
     *      summary="Delete client",
     *      description="Supprime un client. La variable ID repésente l'identifiant du client concerné.",
     *      
     *      @OA\Parameter(
     *          name="ID",
     *          in="path",
     *          description="Identifiant du client",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      )
     * )
     */
    public function delete()
    {
        $client = \App\Models\Client::where('IDclient', '=', request('ID'))->first();
        if (empty($client)) {
            return response(['error' => 'Client not found'], 404);
        } else {
            $client->delete();
            return response('', 200);
        }
    }
}
