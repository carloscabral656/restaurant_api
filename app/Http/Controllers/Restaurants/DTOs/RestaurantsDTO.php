<?php

namespace App\Http\Controllers\Restaurants\DTOs;

use App\Http\Controllers\Gastronomies\DTOs\GastronomiesDTO;
use App\Http\Controllers\RestaurantsType\DTOs\RestaurantsTypeDTO;
use App\Models\Restaurant;
use App\Models\RestaurantType;

class RestaurantsDTO {

    protected Restaurant $restaurant;
    protected GastronomiesDTO $gastronomyDTO;
    protected RestaurantsTypeDTO $restaurantsTypeDTO;

    public function __construct(){
        $this->gastronomyDTO = app(GastronomiesDTO::class);
        $this->restaurantsTypeDTO = app(RestaurantsTypeDTO::class);
    }

    public function createDTO(Restaurant $restaurant){
        return [
            'id'              => $restaurant->id,
            'name'            => $restaurant->name,
            'description'     => $restaurant->description,
            'gastronomy'      => $this->gastronomyDTO->createDTO($restaurant->gastronomy),
            'restaurant_type' => $this->restaurantsTypeDTO->createDTO($restaurant->restaurantType)
        ];
    }
}
