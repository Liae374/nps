<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackController extends Controller
{
    public function admin() 
    {
        $notes = \App\Models\Note::all();
        $note = new \App\Models\Note;
        $stats = $note->stats();
        return view('admin', [
            'notes' => $notes,
            'stats' => $stats,
            'average' => $note->average(),
            'NPS' => $note->NPS()
        ]);
    }

    public function delete()
    {
        $note = \App\Models\Note::find(request('id'));
        $note->delete();
        $stats = $note->stats();
        $notes = \App\Models\Note::all();
        return view('admin', [
            'notes' => $notes,
            'stats' => $stats,
            'average' => $note->average(),
            'NPS' => $note->NPS()
        ]);
    }

    public function deleteAll()
    {
        $notes = \App\Models\Note::all();
        foreach ($notes as $note) {
            $note->delete();
        }
        return 'blue';
    }

    public function login()
    {
        define('AD_LOGIN','admin');
        define('AD_PASSWORD','mp');

        return view('login', [
            'logError' => ''
        ]);
    }

    public function connection()
    {
        define('AD_LOGIN','admin');
        define('AD_PASSWORD','mp');

        $logError = '';
        if ((request('login') == AD_LOGIN) && (request('password') == AD_PASSWORD) ) {
            session()->put('login', AD_LOGIN);
            header('Location: /admin');
            exit();
        } else {
            $logError = ' is-invalid';
        }
        return view('login', [
            'logError' => $logError
        ]);
    }

    public function search()
    {
        $note = \App\Models\Note::find(request('id'));
        $stats = $note->stats();
        return view('admin', [
            'notes' => [$note],
            'stats' => $stats,
            'average' => $note->average(),
            'NPS' => $note->NPS()
        ]);
    }

}
