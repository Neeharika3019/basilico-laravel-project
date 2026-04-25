<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    protected $table = 'specials';

    protected $fillable = [
        'dish_name',
        'price',
        'description',
        'image_url'
    ];

    public $timestamps = false;
}