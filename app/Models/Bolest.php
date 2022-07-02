<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolest extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv', 
    ];
    public $timestamps = false;
    protected $primaryKey = 'bolest_id';
    protected $table = 'bolesti';
}
