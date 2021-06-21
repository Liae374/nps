<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * @OA\Post(
     *      path="/note",
     *      operationId="create",
     *      tags={"Note"},
     *      summary="Add new Note",
     *      description="Ajoute une nouvelle note. La variable id_client repésente l'identifiant du client donnant la note.",
     *      
     *      @OA\Parameter(
     *          name="rating",
     *          in="query",
     *          description="Valeur de la note",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="id_client",
     *          in="query",
     *          description="Identifiant du client",
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
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      )
     * )
     */
    public function create()
    {
        $note = new \App\Models\Note;
        $client = \App\Models\Client::findOrFail(request('id_client'));
        if ((request('rating') >= 0) && (request('rating') <= 10)) {
            $note = \App\Models\Note::create([
                'rating' => request('rating'),
                'id_client' => request('id_client')
            ]);
            return response($note,  201);
        } else {
            return response(['error' => 'Wrong value'], 400);
        }
    }

    /**
     * @OA\Get(
     *      path="/note",
     *      operationId="read",
     *      tags={"Note"},
     *      summary="Read Note",
     *      description="Retourne une note. La variable id repésente l'identifiant de la note concernée, si null retourne toutes les notes contenues dans la base de donnée.",
     *      
     *      @OA\Parameter(
     *          name="id",
     *          in="query",
     *          description="Identifiant de la note",
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
            return response(\App\Models\Note::All(), 200);
        }
        return (\App\Models\Note::findOrFail(request('id')));
    }

    /**
     * @OA\Put(
     *      path="/note",
     *      operationId="update",
     *      tags={"Note"},
     *      summary="Update Note",
     *      description="Remplace la valeur 'rating' de la note obtenue par l'identifiant 'id' par le paramètre 'rating'.",
     *      @OA\Parameter(
     *          name="rating",
     *          in="query",
     *          description="Valeur de la nouvelle note",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="query",
     *          description="Identifiant de la note",
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
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      )
     * )
     */
    public function update()
    {
        $note = \App\Models\Note::findOrFail(request('id'));
        if ((request('rating') >= 0) && (request('rating') <= 10)) {
            $note->rating = request('rating');
            $note->save();
            return response($note, 201);
        } else {
            return response(['error' => 'Wrong value'], 400);
        }
    }

    /**
     * @OA\Delete(
     *      path="/note",
     *      operationId="delete",
     *      tags={"Note"},
     *      summary="Delete Note",
     *      description="Supprime une note. La variable id repésente l'identifiant de la note concernée.",
     *      
     *      @OA\Parameter(
     *          name="id",
     *          in="query",
     *          description="Identifiant de la note",
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
        $note = \App\Models\Note::findOrFail(request('id'));
        $note->delete();
        return response('', 200);
    }
}
