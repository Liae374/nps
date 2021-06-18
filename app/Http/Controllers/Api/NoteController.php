<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create()
    {
        $note = new \App\Models\Note;
        $client = \App\Models\Client::where('IDclient', '=', request('ID'))->first();
        if ($client == null) {
            return response('', 404);
        } else {
            if ((request('rating') >= 0) && (request('rating') <= 10)) {
                $note->rating = request('rating');
                $note->IDclient = request('ID');
                $note->save();
                return response($note,  200);
            } else {
                return response('', 400);
            }
        }
    }

    public function read()
    {
        $note = \App\Models\Note::find(request('ID'));
        if ($note == null) {
            return response('', 404);
        } else {
            return response($note, 200);
        }
    }

    public function readAll()
    {
        $notes = \App\Models\Note::All();
        if ($notes == null) {
            return response('', 404);
        } else {
            return response($notes, 200);
        }
    }

    public function update()
    {
        $note = \App\Models\Note::find(request('ID'));
        if ($note == null) {
            return response('', 404);
        } elseif ((request('rating') >= 0) && (request('rating') <= 10)) {
            $note->rating = request('rating');
            $note->save();
            return response($note, 200);
        } else {
            return response('', 400);
        }
    }

    public function delete()
    {
        $note = \App\Models\Note::find(request('ID'));
        if ($note == null) {
            return response('', 404);
        } else {
            $note->delete();
            return response();
        }
    }
}
