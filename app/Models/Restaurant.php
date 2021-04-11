<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Restaurant extends Model
{
    use HasFactory;

    public function menuRestaurant()   //--> funkcijos vardas menuRestaurant nieko nereiskia, pasirenkam i koki sugalvojam
    {
        // return $this->belongsTo(Menu::class, 'menu_id', 'id');
        return $this->belongsTo('App\Models\Menu', 'menu_id', 'id');
       
    }
 
}


