<?php

namespace App\Services\Restaurants;

use App\Models\Restaurant;
use App\Services\ServiceAbstract;

class RestaurantsService extends ServiceAbstract{

    public Restaurant $restaurantModel;

    public function __construct(Restaurant $restaurantModel)
    {
        $this->model = $restaurantModel;
    }

}
