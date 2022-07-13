<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class order extends Model
{

    protected $fillable = [
        'user_id',
        'fnam',
        'lnam',
        'email',
        'address',


    ];
    public function user (){
        return $this-> hasOne(User::class ,'id','user_id');
    }
    use SoftDeletes;
}
