<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrolniPregled extends Model
{
    use HasFactory;

    protected $fillable = [
        'estriol', 'hemoglobin', 'beta_hCG', 'trudnica_id', 'kontrola_id', 'termin'
    ];
    public $timestamps = false;
    protected $primaryKey = 'kontrola_id';
    protected $table = 'kontrolni_pregled';
}
