<?php

namespace App\Services\Restaurants;

use App\Models\Restaurant;
use App\Services\ServiceAbstract;
use Illuminate\Database\Eloquent\Collection;
use Exception;

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
        try
        {
            $restaurant = Restaurant::with(
                [
                    'gastronomy' => function($query){
                        if(isset($filters) && array_key_exists('id_gastronomy', $filters)){
                            $query->where('gastronomies.id', '=', $filters['id_gastronomy']);
                        }
                    }, 
                    
                    'restaurant_type' => function($query){
                        if(isset($filters) && array_key_exists('id_type_restaurant', $filters)){
                            $query->where('restaurant.id_type_restaurant', '=', $filters['id_type_restaurant']);
                        }
                    }, 
                    
                    'address', 'owner'
                ]
            );

            if(isset($filters) && array_key_exists('name', $filters))
            {
                $restaurant->where('restaurants.name', 'like', "%{$filters['name']}%");
            }

            return $restaurant->orderBy('restaurants.name')->get();
        }catch(Exception $e){
            throw $e;
        }
    }

}
