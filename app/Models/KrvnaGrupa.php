<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KrvnaGrupa extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupa', 'rh_faktor'
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'krvna_grupa';
}
