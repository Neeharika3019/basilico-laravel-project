<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class);
    }
}
