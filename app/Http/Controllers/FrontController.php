<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function form() 
    {
        $client = \App\Models\Client::where('IDclient', '=', request('IDclient'))->first();
        if ($client !== null) {
            return view('form', [
                'IDclient' => request('IDclient')
            ]);
        }
        return redirect('/')->withErrors(['login' => 'identifiant incorrect']);
    }

    public function thanks()
    {
        $note = new \App\Models\Note;
        if (request('rating') !== null){
            $note->rating = request('rating');
        } else {
            $note->rating = 0;
        }
        $note->IDclient = request('IDclient');
        $note->save();
        return view('thanks', [
            'rating' => $note->rating,
            'id' => $note->id,
            'IDclient' => request('IDclient')
        ]);
    }

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

    public function put()
    {
        $note = \App\Models\Note::find(request('id'));
        $note->rating = request('rating');
        $note->save();
        return view('thanks', [
            'id' => request('id'),
            'rating' => request('rating'),
            'IDclient' => request('IDclient')
        ]);
    }
}
