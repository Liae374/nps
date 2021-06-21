<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackController extends Controller
{
    /**
     * Récupère les statistiques et les notes contenues dans la base de donnée, 
     * puis affiche la page admin.
     */
    public function admin() 
    {
        $notes = \App\Models\Note::all();
        $clients = \App\Models\Client::all();
        $note = new \App\Models\Note;
        $stats = $note->stats();
        return view('admin', [
            'clients' => $clients,
            'notes' => $notes,
            'stats' => $stats,
            'average' => $note->average(),
            'NPS' => $note->NPS()
        ]);
    }

    /**
     * Supprime la note possédant l'identifiant 'id',
     * puis redirige vers la page admin.
     */
    public function deleteNote()
    {
        $note = \App\Models\Note::find(request('id'));
        $note->delete();
        return redirect('/admin');
    }

    /**
     * Supprime le client possédant l'identifiant 'id' et les notes qui lui sont associées,
     * puis redirige vers la page admin.
     */
    public function deleteClient()
    {
        $client = \App\Models\Client::find(request('id'));
        $client->delete();
        return redirect('/admin');
    }

    /**
     * Supprime toutes les notes présentes dans la base de donnée,
     * puis redirige vers la page admin.
     */
    public function deleteAll()
    {
        \App\Models\Note::query()->truncate();
        return redirect('/admin');
    }

    /**
     * Affiche la page admin avec un tableau contenant le résultat de la recherche.
     */
    public function search()
    {
        $note = new \App\Models\Note;
        $stats = $note->stats();
        $notes = \App\Models\Note::where('id_client', '=', request('id'))->get();
        $clients = \App\Models\Client::find(request('id'));
        if ($notes == null) {
            $notes = [];
        }
        if ($clients == null) {
            $clients = [];
        } else {
            $clients = [$clients];
        }
        return view('admin', [
            'clients' => $clients,
            'notes' => $notes,
            'stats' => $stats,
            'average' => $note->average(),
            'NPS' => $note->NPS()
        ]);
    }
}
