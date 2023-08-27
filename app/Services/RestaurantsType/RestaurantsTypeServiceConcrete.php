<?php

namespace App\Services\RestaurantsType;

use App\Models\RestaurantType;
use App\Services\ServiceAbstract;

class RestaurantsTypeServiceConcrete extends ServiceAbstract {

    public function __construct(RestaurantType $restaurantType)
    {
        $this->model = $restaurantType;
    }

}