<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * @OA\Post(
     *      path="/client/{ID}/note",
     *      operationId="create",
     *      tags={"Note"},
     *      summary="Add new Note",
     *      description="Ajoute une nouvelle note. La variable ID repésente l'identifiant du client donnant la note.",
     *      
     *      @OA\Parameter(
     *          name="rating",
     *          in="query",
     *          description="Valeur de la note",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="ID",
     *          in="path",
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
    public function create()
    {
        $note = new \App\Models\Note;
        $client = \App\Models\Client::where('IDclient', '=', request('ID'))->first();
        if ($client == null) {
            return response(['error' => 'Client not found'], 404);
        } else {
            if ((request('rating') >= 0) && (request('rating') <= 10)) {
                $note->rating = request('rating');
                $note->IDclient = request('ID');
                $note->save();
                return response($note,  201);
            } else {
                return response(['error' => 'Wrong value'], 400);
            }
        }
    }

    /**
     * @OA\Get(
     *      path="/note/{ID}",
     *      operationId="read",
     *      tags={"Note"},
     *      summary="Read Note",
     *      description="Retourne une note. La variable ID repésente l'identifiant de la note concernée.",
     *      
     *      @OA\Parameter(
     *          name="ID",
     *          in="path",
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
        $note = \App\Models\Note::find(request('ID'));
        if ($note == null) {
            return response(['error' => 'Value not found'], 404);
        } else {
            return response($note, 200);
        }
    }

    /**
     * @OA\Get(
     *      path="/note",
     *      operationId="readAll",
     *      tags={"Note"},
     *      summary="Read all Notes",
     *      description="Retourne toutes les notes contenues dans la base de donnée.",
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
        $notes = \App\Models\Note::All();
        if ($notes == null) {
            return response(['error' => 'Value not found'], 404);
        } else {
            return response($notes, 200);
        }
    }

    /**
     * @OA\Put(
     *      path="/note/{ID}",
     *      operationId="update",
     *      tags={"Note"},
     *      summary="Update Note",
     *      description="Remplace la valeur 'rating' de la note obtenue par l'identifiant 'ID' par le paramètre 'rating'.",
     *      @OA\Parameter(
     *          name="rating",
     *          in="query",
     *          description="Valeur de la nouvelle note",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="ID",
     *          in="path",
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
        $note = \App\Models\Note::find(request('ID'));
        if ($note == null) {
            return response(['error' => 'Value not found'], 404);
        } elseif ((request('rating') >= 0) && (request('rating') <= 10)) {
            $note->rating = request('rating');
            $note->save();
            return response($note, 201);
        } else {
            return response(['error' => 'Wrong value'], 400);
        }
    }

    /**
     * @OA\Delete(
     *      path="/note/{ID}",
     *      operationId="delete",
     *      tags={"Note"},
     *      summary="Delete Note",
     *      description="Supprime une note. La variable ID repésente l'identifiant de la note concernée.",
     *      
     *      @OA\Parameter(
     *          name="ID",
     *          in="path",
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
        $note = \App\Models\Note::find(request('ID'));
        if ($note == null) {
            return response(['error' => 'Value not found'], 404);
        } else {
            $note->delete();
            return response();
        }
    }
}
