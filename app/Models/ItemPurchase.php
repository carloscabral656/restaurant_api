<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPurchase extends Model
{
    use HasFactory;

    protected $table = "items_purchases";
    protected $fillable = ["id_item", "id_purchase"];
}
