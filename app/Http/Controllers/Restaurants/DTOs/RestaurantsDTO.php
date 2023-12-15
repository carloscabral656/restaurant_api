<?php

namespace App\Http\Controllers\Restaurants\DTOs;

use App\Http\Controllers\Gastronomies\DTOs\GastronomiesDTO;
use App\Http\Controllers\Menus\DTOs\MenuDTO;
use App\Http\Controllers\RestaurantsType\DTOs\RestaurantsTypeDTO;
use App\Http\Controllers\Users\DTOs\UserDTO;
use App\Models\Restaurant;

class RestaurantsDTO
{

    protected Restaurant $restaurant;
    protected GastronomiesDTO $gastronomyDTO;
    protected RestaurantsTypeDTO $restaurantsTypeDTO;
    protected MenuDTO $menuDTO;
    protected UserDTO $userDTO;

    public function __construct()
    {
        $this->gastronomyDTO = app(GastronomiesDTO::class);
        $this->restaurantsTypeDTO = app(RestaurantsTypeDTO::class);
        $this->menuDTO = app(MenuDTO::class);
        $this->userDTO = app(UserDTO::class);
    }

    public function createDTO(Restaurant $restaurant)
    {
        return [
            'id'              => $restaurant?->id,
            'name'            => $restaurant?->name,
            'description'     => $restaurant?->description,
            'gastronomy'      => $this->gastronomyDTO?->createDTO($restaurant->gastronomy),
            'restaurant_type' => $this->restaurantsTypeDTO?->createDTO($restaurant->restaurant_type),
            'menus'           => $this->menuDTO?->createDTO($restaurant->menus),
            'owner'           => $this->userDTO?->createDTO($restaurant->owner),
        ];
    }
}
