<?php

namespace App\Http\Controllers\RestaurantsType\DTOs;

use App\Models\RestaurantType;

class RestaurantsTypeDTO {

    private RestaurantType $restaurantType;
    
    public function __construct(RestaurantType $restaurantType)
    {
        $this->restaurantType = $restaurantType;
    }

    public function createDTO()
    {
        return $this->restaurantType->description;
    }

}

