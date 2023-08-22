<?php

namespace App\Http\Controllers\Restaurants\DTOs;

use App\Http\Controllers\Gastronomies\DTOs\GastronomiesDTO;
use App\Models\Restaurant;

class RestaurantsDTO {
    protected Restaurant $restaurant;
    protected GastronomiesDTO $gastronomyDTO;

    public function __construct(){
        $this->gastronomyDTO = app(GastronomiesDTO::class);
    }

    public function createDTO(Restaurant $restaurant){
        return [
            'id'   => $restaurant->id,
            'name' => $restaurant->name,
            'description' => $restaurant->description,
            'gastronomy'  => $this->gastronomyDTO->createDTO($restaurant->gastronomy)
        ];
    }
}
