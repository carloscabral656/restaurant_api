<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = "items";
    protected $fillable = [
        "id", 
        "id_menu", 
        "name", 
        "description", 
        "img_item",
        "unit_price",
        "discount"
    ];
}
