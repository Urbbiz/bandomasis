<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class Menu extends Model
{
    use HasFactory;

    public function restaurantMenu()
    {
        return $this->hasMany('App\Models\Restaurant', 'menu_id', 'id');
    }
 
}
