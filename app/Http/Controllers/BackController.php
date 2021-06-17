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
        \App\Models\Note::query()->truncate();
        header('Location: /admin');
        exit;
    }

    public function search()
    {
        $note = \App\Models\Note::find(request('id'));
        if ($note == null) {
            $note = new \App\Models\Note;
            $stats = $note->stats();
            return view('admin', [
                'notes' => [],
                'stats' => $stats,
                'average' => $note->average(),
                'NPS' => $note->NPS()
            ]);
        } else {
            $stats = $note->stats();
            return view('admin', [
                'notes' => [$note],
                'stats' => $stats,
                'average' => $note->average(),
                'NPS' => $note->NPS()
            ]);
        }
    }
}
