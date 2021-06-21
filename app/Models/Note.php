<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        $notes = \App\Models\Note::all();
        $total = 0;
        $neg = 0;
        $pos = 0;
        $pass = 0;
        foreach ($notes as $row) {
            $total += 1;
            if ($row['rating'] <= 6) {
                $neg += 1;
            } elseif ($row['rating'] >= 9) {
                $pos += 1;
            } else {
                $pass += 1;
            }
        }
        $co = null;
        $all['promoteurs'] = $pos;
        $all['detracteurs'] = $neg;
        $all['passifs'] = $pass;
        return $all;
    }

    /**
    * Retourne le NPS des notes contenues dans la base de donnée.
    *
    * @return int le NPS
    */
    function NPS()
    {
        $notes = \App\Models\Note::all();
        $total = 0;
        $neg = 0;
        $pos = 0;
        foreach ($notes as $row) {
            $total += 1;
            if ($row['rating'] <= 6) {
                $neg += 1;
            } elseif ($row['rating'] >= 9) {
                $pos += 1;
            }
        } 
        $co = null;
        if ($total==0) {
            return 'null';
        }
        return round($pos/$total*100 - $neg/$total*100, 3);
    }

    /**
    * Fonction retournant la moyenne des notes contenues dans la base de donnée.
    * 
    * @return int La moyenne
    */
    function average()
    {
        $notes = \App\Models\Note::all();
        $total = 0;
        $average = 0;
        foreach ($notes as $row) {
            $average += $row['rating'];
            $total += 1;
        } 
        $co = null;
        if ($total==0) {
            return 'null';
        }
        return round($average/$total, 3);
    }
}
