<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';

    protected $fillable = [
        'username',
        'rating',
        'text',
        'created_at'
    ];

    public $timestamps = false;
}