<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = "restaurants";
    protected $primaryKey = 'id';
    protected $fillable = ["name", "description", "id_gastronomy", "id_restaurant_type", "id_owner", "id_address"];
    protected $with = ['gastronomy', 'restaurantType'];

    public function gastronomy(){
        return $this->hasOne(Gastronomy::class, 'id', 'id_gastronomy');
    }

    public function restaurantType(){
        return $this->hasOne(RestaurantType::class, 'id', 'id_restaurant_type');
    }

    public function menus() : HasMany{
        return $this->hasMany(Menu::class, 'id_restaurant', 'id');
    }
}
