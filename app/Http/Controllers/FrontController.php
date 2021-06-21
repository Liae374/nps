<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Affiche la page d'authentification client.
     */
    public function authentication()
    {
        return view('authentication', []);
    }

    public function delete()
    {
        $note = \App\Models\Note::find(request('id'));
        $note->delete();
        return redirect('/client');
    }

    /**
    * Si l'identifiant client existe dans la base de donnée, affiche le formulaire, 
    * redirection vers l'authentification sinon.
    */
    public function form() 
    {
        $client = \App\Models\Client::where('id', '=', request('id_client'))->first();
        if ($client !== null) {
            return view('form', [
                'id_client' => request('id_client')
            ]);
        }
        return redirect('/')->withErrors(['login' => 'identifiant incorrect']);
    }

    /**
     * Enregistre la note dans la base de donnée,
     * puis affiche la page de remerciement.
     */
    public function thanks()
    {
        $note = new \App\Models\Note;
        if (request('rating') !== null){
            $note->rating = request('rating');
        } else {
            $note->rating = 0;
        }
        $note->id_client = request('id_client');
        $note->save();
        return view('thanks', [
            'rating' => $note->rating,
            'id' => $note->id,
            'id_client' => request('id_client')
        ]);
    }

    /**
     * Modifie la valeur d'une note déjà enregistrée dans la base de donnée,
     * et réaffiche la page de remerciement.
     */
    public function put()
    {
        $note = \App\Models\Note::find(request('id'));
        $note->rating = request('rating');
        $note->save();
        return view('thanks', [
            'id' => request('id'),
            'rating' => request('rating'),
            'id_client' => request('id_client')
        ]);
    }
}
