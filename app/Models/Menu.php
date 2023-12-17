<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menus";

    protected $fillable = [
        "id_restaurant",
        "name",
        "description"
    ];

    protected $with = ['itens'];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant', 'id');
    }

    public function itens(): HasMany
    {
        return $this->hasMany(Item::class, 'id_menu', 'id');
    }

}


