<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trudnoca extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv', 
    ];
    public $timestamps = false;
    protected $primaryKey = 'trudnoca_id';
    protected $table = 'trudnoca';
}
