<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Note;

use App\Models\Client;

class BackController extends Controller
{
    /**
     * Récupère les statistiques et les notes contenues dans la base de donnée, 
     * puis affiche la page admin.
     */
    public function admin() 
    {
        $notes = Note::all();
        $clients = Client::all();
        $note = new Note;
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
    public function deleteNote(int $id)
    {
        $note = Note::find($id);
        $note->delete();
        return redirect('/admin')->withSuccess('Note successfully deleted');
    }

    /**
     * Supprime le client possédant l'identifiant 'id' et les notes qui lui sont associées,
     * puis redirige vers la page admin.
     */
    public function deleteClient(int $id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect('/admin')->withSuccess('Client successfully deleted');
    }

    /**
     * Supprime toutes les notes présentes dans la base de donnée,
     * puis redirige vers la page admin.
     */
    public function deleteAll()
    {
        Note::query()->truncate();
        return redirect('/admin')->withSuccess('All notes have been deleted');
    }

    /**
     * Affiche la page admin avec un tableau contenant le résultat de la recherche.
     */
    public function search()
    {
        $note = new Note;
        $stats = $note->stats();
        $notes = Note::where('id_client', '=', request('id'))->get();
        $clients = Client::find(request('id'));
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

    /**
     * Enregistre un nouveau client,
     * puis redirige vers la page admin.
     */
    public function registeredClient(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:clients|email',
            'name' => 'required'
        ]);
        $client = Client::create([
            'name' => request('name'),
            'email' => request('email')
        ]);
        return redirect('/admin')->withSuccess('Client added successfully');
    }
}
