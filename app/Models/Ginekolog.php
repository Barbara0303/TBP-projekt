<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ginekolog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ime', 'prezime', 'email', 'lozinka'
    ];
    public $timestamps = false;
    protected $primaryKey = 'ginekolog_id';
    protected $table = 'ginekolog';
}
