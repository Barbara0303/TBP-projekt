<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BolestiTrudnice  extends Model
{
    use HasFactory;

    protected $fillable = [
        'bolest_id', 'trudnica_id' 
    ];
    public $timestamps = false;
    protected $primaryKey = ['bolest_id', 'trudnica_id'];
    public $incrementing = false;
    protected $table = 'bolesti_trudnice';
}
