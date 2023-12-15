<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menus";

    protected $fillable = [
        "id",
        "id_restaurant",
        "name"
    ];

    protected $with = ['itens'];

    public function itens(): HasMany
    {
        return $this->hasMany(Item::class, 'id_menu', 'id');
    }

}


