<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantType extends Model
{
    use HasFactory;
    protected $table = "restaurant_type";
    protected $primaryKey = "id";
    protected $fillable = [
        "description"
    ];
}
