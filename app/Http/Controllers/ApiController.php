<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function create()
    {
        $note = new \App\Models\Note;
        if ((request('rating')>=0) && (request('rating')<=10)) {
            $note->rating = request('rating');
            $note->save();
            return response()->json([
                'resultat' => 'ajout reussi',
                'note' => $note
            ]);
        } else {
            return response()->json([
                'resultat' => 'valeur incorrecte'
            ]);
        }
    }

    public function read()
    {
        $note = \App\Models\Note::find(request('id'));
        if ($note == null) {
            return response()->json([
                'resultat' => 'note inexistante'
            ]);
        } else {
            return response()->json([
                'resultat' => 'requete reussie',
                'note' => $note
            ]);
        }
    }

    public function update()
    {
        $note = \App\Models\Note::find(request('id'));
        if ($note == null) {
            return response()->json([
                'resultat' => 'note inexistante'
            ]);
        } elseif ((request('rating')>=0) && (request('rating')<=10)) {
            $note->rating = request('rating');
            $note->save();
            return response()->json([
                'resultat' => 'modification effectuee',
                'note' => $note
            ]);
        } else {
            return response()->json([
                'resultat' => 'valeur incorrecte'
            ]);
        }
    }

    public function delete()
    {
        $note = \App\Models\Note::find(request('id'));
        if ($note == null) {
            return response()->json([
                'resultat' => 'note inexistante'
            ]);
        } else {
            $note->delete();
            return response()->json([
                'resultat' => 'suppression reussie'
            ]);
        }
    }
}
