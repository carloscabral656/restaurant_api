<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menus";
    protected $fillable = ["id", "id_restaurant"];

    public function itens(){
        return $this->hasMany(Item::class, 'id_menu', 'id');
    }

}


