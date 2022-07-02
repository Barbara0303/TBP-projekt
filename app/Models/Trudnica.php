<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trudnica extends Model
{
    use HasFactory;

    protected $fillable = [
        'ime', 'prezime', 'datum_rodenja', 
        'zadnja_mjesecnica', 'tezina', 'visina',
        'ginekolog_id', 'krvna_grupa_id', 'trajanje_ciklusa',
        'oib', 'kontakt_broj', 'email'
    ];
    public $timestamps = false;
    protected $primaryKey = 'trudnica_id';
    protected $table = 'trudnica';
}
