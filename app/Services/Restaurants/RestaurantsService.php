<?php

namespace App\Services\Restaurants;

use App\Models\Restaurant;
use App\Models\RestaurantType;
use App\Services\ServiceAbstract;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class RestaurantsService extends ServiceAbstract
{

    public Restaurant $restaurant;

    /**
     * Display a listing of the resource.
     *
     * @return Collection
    */
    public function __construct(Restaurant $restaurantModel)
    {
        $this->model = $restaurantModel;
    }

    /**
     * Display a listing of the resource.
     *  
     * @param array $filters
     * @return Collection
    */
    public function index(array $filters = null) : Collection | null
    {
        try{
            $restaurants = $this
                            ->restaurant
                            ->join('gastronomies', 'restaurants.id', '=', 'gastronomies.id', 'left')
                            ->join('restaurant_type', 'restaurants.id', '=', 'restaurant_type.id', 'left');  

            if(isset($filters)){
                if(array_key_exists('name', $filters)){
                    $restaurants->where('restaurant.name', 'like', "%$filters[name]%");
                }

                if(array_key_exists('gastronomy', $filters)){
                    $restaurants->where('gastronomies.id', '=', (int)$filters['gastronomy']);
                }

                if(array_key_exists('restaurant_type', $filters)){
                    $restaurants->where('restaurant_type.id', '=', (int)$filters['restaurant_type']);
                }
            }

            return $restaurants->get();
        }catch(Exception $e){
            throw $e;
        }
    }

}
