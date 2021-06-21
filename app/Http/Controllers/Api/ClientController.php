<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @OA\Post(
     *      path="/client",
     *      operationId="create",
     *      tags={"Client"},
     *      summary="Add new client",
     *      description="Ajoute un nouveau client. La variable ID repésente son identifiant.",
     *      
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          description="Email du nouveau client",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          description="Nom du nouveau client",
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
        $client = \App\Models\Client::where('email', '=', request('email'))->first();
        if ($client !== null) {
            return response(['error' => 'Client already exists'], 400);
        } else {
            $client = \App\Models\Client::create([
                'name' => request('name'),
                'email' => request('email')
            ]);
            return response($client, 201);
        }
    }

    /**
     * @OA\Get(
     *      path="/client",
     *      operationId="read",
     *      tags={"Client"},
     *      summary="Read client",
     *      description="Retourne un client. La variable id repésente l'identifiant du client concerné, si null retourne tous les clients contenus dans la base de donnée.",
     *      
     *      @OA\Parameter(
     *          name="id",
     *          in="query",
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
        if (request('id') == null) {
            return response(\App\Models\Client::All(), 200);
        }
        return (\App\Models\Client::findOrFail(request('id')));
    }

    /**
     * @OA\Delete(
     *      path="/client",
     *      operationId="delete",
     *      tags={"Client"},
     *      summary="Delete client",
     *      description="Supprime un client. La variable id repésente l'identifiant du client concerné.",
     *      
     *      @OA\Parameter(
     *          name="id",
     *          in="query",
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
        $client = \App\Models\Client::findOrFail(request('id'));
        $client->delete();
        return response('', 200);
    }
}
