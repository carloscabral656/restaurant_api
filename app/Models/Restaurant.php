<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Restaurant extends Model
{

    use HasFactory;

    protected $table = "restaurants";
    protected $fillable = [
        "name",
        "description",
        "image_restaurant",
        "id_gastronomy",
        "id_restaurant_type",
        "id_owner",
        "id_address"
    ];
    protected $with = [
        'gastronomy',
        'restaurant_type',
        'menus'
    ];

    public function gastronomy() : HasOne
    {
        return $this->hasOne(Gastronomy::class, 'id', 'id_gastronomy');
    }

    public function restaurant_type(): HasOne
    {
        return $this->hasOne(RestaurantType::class, 'id', 'id_restaurant_type');
    }

    public function menus() : HasMany
    {
        return $this->hasMany(Menu::class, 'id_restaurant', 'id');
    }

    public function owner() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'id_owner');
    }

    public function address() : HasOne
    {
        return $this->hasOne(Address::class, 'id', 'id_address');
    }

}
