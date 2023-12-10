<?php

namespace App\Http\Controllers\RestaurantsType\DTOs;

use App\Models\RestaurantType;

class RestaurantsTypeDTO {

    public function createDTO(RestaurantType $restaurantType)
    {
        return [
            "id"          => $restaurantType->id,
            "description" => $restaurantType->description
        ];
    }

}

