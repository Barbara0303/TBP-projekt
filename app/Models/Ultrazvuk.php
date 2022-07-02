<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ultrazvuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'napomene', 'termin'
    ];
    public $timestamps = false;
    protected $primaryKey = 'ultrazvuk_id';
    protected $table = 'ultrazvuk';
}
