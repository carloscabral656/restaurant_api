<?php

namespace App\Services\Restaurants;

use App\Models\Restaurant;
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
    public function __construct(Restaurant $restaurant)
    {
        parent::__construct($restaurant);
        $this->restaurant = $restaurant;
    }

    /**
     * Display a listing of the resource.
     *  
     * @param array $filters
     * @return ?Collection
    */
    public function index(array $filters = null) : ?Collection
    {
        try{
            
            $restaurants = $this
                        ->restaurant
                        ->join('gastronomies', 'restaurants.id_gastronomy', '=', 'gastronomies.id', 'left')
                        ->join('restaurant_type', 'restaurants.id_restaurant_type', '=', 'restaurant_type.id', 'left');  
        
            if(isset($filters)){
                if(array_key_exists('name', $filters)){
                    $restaurants->where('restaurants.name', 'like', "%$filters[name]%");
                }

                if(array_key_exists('gastronomy', $filters)){
                    $restaurants->where('gastronomies.id', '=', (int)$filters['gastronomy']);
                }

                if(array_key_exists('restaurant_type', $filters)){
                    $restaurants->where('restaurant_type.id', '=', (int)$filters['restaurant_type']);
                }
            }

            return $restaurants
                ->select('restaurants.*')
                ->orderBy('restaurants.name')
                ->get();
        }catch(Exception $e){
            throw $e;
        }
    }

}
