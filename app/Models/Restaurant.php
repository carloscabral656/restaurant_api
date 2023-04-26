<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = "restaurants";
    protected $fillable = ["description", "id_gastronomy", "id_restaurant_type", "id_owner", "id_address"];
}
