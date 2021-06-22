<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Note;

use App\Models\Client;

use Validator;

class NoteController extends Controller
{
    /**
     * @OA\Post(
     *      path="/client/{id}/note",
     *      operationId="create",
     *      tags={"Note"},
     *      summary="Add new Note",
     *      description="Add a new note to the database. The 'id' variable represents the identifier of the client concerned.",
     *      
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Client identifier",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="rating",
     *          in="query",
     *          description="Note value",
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
     *          description="Not found"
     *      )
     * )
     */
    public function create(int $id)
    {
        $rules = array(
            'id' => 'required|exists:clients',
            'rating' => 'required|integer|max:10|min:0'
        );
        $validator = Validator::make(['id' => $id, 'rating' => request('rating')], $rules);
        if ($validator->fails()){
            return response($validator->errors(), 400);
        }
        else {
            $note = Note::create([
                'rating' => request('rating'),
                'id_client' => $id
            ]);
            return response($note,  201);
        }
    }

    /**
     * @OA\Get(
     *      path="/note/{id}",
     *      operationId="read",
     *      tags={"Note"},
     *      summary="Read Note",
     *      description="Returns information about the note identified by 'id'."
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Note identifier",
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
        return Note::findOrFail($id);
    }

        /**
     * @OA\Get(
     *      path="/note",
     *      operationId="index",
     *      tags={"Client"},
     *      summary="Reads all notes",
     *      description="Returns all notes contained in the database",
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
        return response(Note::all(), 200);
    }

    /**
     * @OA\Put(
     *      path="/note/{id}",
     *      operationId="update",
     *      tags={"Note"},
     *      summary="Update Note",
     *      description="Replaces the 'rating' value of the note obtained with the 'id' identifier by the 'rating' parameter.",
     *      @OA\Parameter(
     *          name="rating",
     *          in="query",
     *          description="Note value",
     *          required=true
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Note identifier",
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
     *          description="Not found"
     *      )
     * )
     */
    public function update(int $id)
    {
        $note = Note::findOrFail($id);
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
     *      path="/note/{id}",
     *      operationId="delete",
     *      tags={"Note"},
     *      summary="Delete Note",
     *      description="Removes the note identified by 'id'.",
     *      
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Note identifier",
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
    public function delete(int $id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return response('Note successfully deleted', 200);
    }
}
