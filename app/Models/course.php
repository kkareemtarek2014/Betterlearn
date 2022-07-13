<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class course extends Model
{
    protected $fillable = [
        'id',
        'name',
        'Disc',
        'image',
        'actor',
        'actor_image',
        'featured',
        'cat',
        'price',
    ];
    use SoftDeletes;

}
