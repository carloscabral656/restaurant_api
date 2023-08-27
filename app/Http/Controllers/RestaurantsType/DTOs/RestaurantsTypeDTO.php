<?php

namespace App\Http\Controllers\RestaurantsType\DTOs;

use App\Models\RestaurantType;

class RestaurantsTypeDTO {
    protected RestaurantType $restaurantType;

    public function __construct(RestaurantType $restaurantType)
    {
        $this->restaurantType  = $restaurantType;
    }
    
    public function createDTO(){
        return [
            "id"          => $this->restaurantType->id,
            "description" => $this->restaurantType->description
        ];
    }
}

