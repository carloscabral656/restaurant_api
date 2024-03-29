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
        "telephone",
        "image_restaurant",
        "id_gastronomy",
        "id_restaurant_type",
        "id_owner",
        "id_address"
    ];

    public $with = ["gastronomy"];

    public function evaluationAvg(): ?float
    {
        return round($this->purchases?->pluck('evaluation')?->pluck('evaluation')?->avg(), 1);
    }

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

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'id_restaurant', 'id');
    }

}
