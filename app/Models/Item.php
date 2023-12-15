<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    use HasFactory;

    protected $table = "items";

    protected $fillable = [
        "id_menu",
        "id_type_item",
        "id_sale",
        "name",
        "description",
        "img_item",
        "unit_price"
    ];

    protected $with = ['type_item', 'sale'];

    /**
     *
    */
    public function type_item(): HasOne
    {
        return $this->hasOne(TypeItem::class, 'id', 'id_type_item');
    }

    /**
     *
    */
    public function sale(): HasOne
    {
        return  $this->hasOne(Sale::class, 'id', 'id_sale');
    }
}
