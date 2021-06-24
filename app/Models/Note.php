<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Note;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['rating', 'id_client'];
    /**
    * Retourne le nombre de detracteurs/passifs/promoteurs contenus dans la base de donnée.
    *
    * @return array 
    */
    function stats()
    {
        $notes = Note::all();
        $detracteurs = 0;
        $promoteurs = 0;
        $passifs = 0;

        foreach ($notes as $note) {
            if ($note['rating'] <= 6) {
                $detracteurs += 1;
            } elseif ($note['rating'] >= 9) {
                $promoteurs += 1;
            } else {
                $passifs += 1;
            }
        }

        $all['promoteurs'] = $promoteurs;
        $all['detracteurs'] = $detracteurs;
        $all['passifs'] = $passifs;
        return $all;
    }

    /**
    * Retourne le NPS des notes contenues dans la base de donnée.
    *
    * @return int le NPS
    */
    function NPS()
    {
        $notes = Note::all();
        $total = 0;
        $detracteurs = 0;
        $promoteurs = 0;

        foreach ($notes as $note) {
            $total += 1;
            if ($note['rating'] <= 6) {
                $detracteurs += 1;
            } elseif ($note['rating'] >= 9) {
                $promoteurs += 1;
            }
        } 
        
        if ($total == 0) {
            return 'Aucune note';
        }
        return round($promoteurs/$total*100 - $detracteurs/$total*100, 3);
    }

    /**
    * Fonction retournant la moyenne des notes contenues dans la base de donnée.
    * 
    * @return int La moyenne
    */
    function average()
    {
        $notes = Note::all();
        $total = 0;
        $average = 0;

        foreach ($notes as $note) {
            $average += $note['rating'];
            $total += 1;
        } 

        if ($total == 0) {
            return 'Aucune note';
        }
        return round($average/$total, 3);
    }
}
