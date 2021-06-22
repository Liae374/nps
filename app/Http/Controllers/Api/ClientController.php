<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Client;

use Validator;

class ClientController extends Controller
{
    /**
     * @OA\Post(
     *      path="/client",
     *      operationId="create",
     *      tags={"Client"},
     *      summary="Add new client",
     *      description="Add a new customer to the database.",
     *      
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          description="Client email",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          description="Client name",
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
    public function create(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response($validator->errors(), 400);
        }
        else {
            $client = Client::create([
                'name' => request('name'),
                'email' => request('email')
            ]);
            return response($client, 201);
        }
    }

    /**
     * @OA\Get(
     *      path="/client/{id}",
     *      operationId="read",
     *      tags={"Client"},
     *      summary="Read client",
     *      description="Returns information about the client identified by 'id'.",
     *      
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Client identifier",
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
     *          description="Not found"
     *      )
     * )
     */
    public function read(int $id)
    {
        if ($id == null) {
            return response(Client::all(), 200);
        }
        return Client::findOrFail($id);
    }

    /**
     * @OA\Get(
     *      path="/client",
     *      operationId="index",
     *      tags={"Client"},
     *      summary="Reads all clients",
     *      description="Returns all clients contained in the database",
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
     *          description="Not found"
     *      )
     * )
     */
    public function index()
    {
        return response(Client::all(), 200);
    }

    /**
     * @OA\Delete(
     *      path="/client/{id}",
     *      operationId="delete",
     *      tags={"Client"},
     *      summary="Delete client",
     *      description="Removes the client identified by 'id'.",
     *      
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Client identifier",
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found"
     *      )
     * )
     */
    public function delete(int $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return response('Client successfully deleted', 200);
    }
}
