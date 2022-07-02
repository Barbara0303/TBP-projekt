<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dijete extends Model
{
    use HasFactory;

    protected $fillable = [
        'tezina', 'duzina', 'genetske_anomalije', 'spol'
    ];
    public $timestamps = false;
    protected $primaryKey = 'dijete_id';
    protected $table = 'dijete';
}
