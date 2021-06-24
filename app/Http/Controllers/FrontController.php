<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

use App\Models\Note;

class FrontController extends Controller
{
    /**
     * Affiche la page d'authentification client.
     */
    public function authentication()
    {
        return view('authentication', []);
    }

    /**
     * Supprime la note possédant l'identifiant 'id'.
     */
    public function destroy(int $id)
    {
        $note = Note::find($id);
        $note->delete();
        return redirect('/client')->withSuccess('Note successfully deleted');
    }

    /**
    * Si l'identifiant client existe dans la base de donnée, affiche le formulaire, 
    * redirection vers l'authentification sinon.
    */
    public function form() 
    {
        $client = Client::where('email', '=', request('email'))->first();
        if ($client !== null) {
            return view('form', [
                'id_client' => $client->id
            ]);
        }
        return redirect('/')->withErrors(['login' => 'identifiant incorrect']);
    }

    /**
     * Enregistre la note dans la base de donnée,
     * puis affiche la page de remerciement.
     */
    public function thanks(int $id_client)
    {
        $note = new Note;
        if (request('rating') !== null){
            $note->rating = request('rating');
        } else {
            $note->rating = 0;
        }
        $note->id_client = $id_client;
        $note->save();
        return view('thanks', [
            'rating' => $note->rating,
            'id' => $note->id,
            'id_client' => $id_client
        ]);
    }

    /**
     * Modifie la valeur d'une note déjà enregistrée dans la base de donnée,
     * et réaffiche la page de remerciement.
     */
    public function update(int $id_client)
    {
        $note = Note::find(request('id'));
        $note->rating = request('rating');
        $note->save();
        return view('thanks', [
            'id' => request('id'),
            'rating' => request('rating'),
            'id_client' => $id_client
        ]);
    }
}
