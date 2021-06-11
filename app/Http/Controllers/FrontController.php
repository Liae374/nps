<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function client() 
    {
        return view('client', [
            'id' => request('id')
        ]);
    }

    public function thanks()
    {
        $note = new \App\Models\Note;
        $note->id = request('id');
        $note->rating = request('rating');
        
        $note->save();

        return view('thanks', [
            'id' => request('id'),
            'rating' => request('rating')
        ]);
    }

    public function authentication()
    {
        return view('authentication', []);
    }
}
