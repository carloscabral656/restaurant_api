<?php

namespace App\Services\Restaurants;

use App\Models\Restaurant;

class RestaurantsService {
    
    public Restaurant $restaurantModel;

    public function __construct(Restaurant $restaurantModel)
    {
        $this->restaurantModel = $restaurantModel;
    }

    public function index(){
        return $this->restaurantModel->all(); 
    }

}