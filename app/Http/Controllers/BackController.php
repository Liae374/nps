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
}
