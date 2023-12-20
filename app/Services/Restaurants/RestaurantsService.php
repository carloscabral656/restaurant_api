<?php

namespace App\Services\Restaurants;

use App\Models\Restaurant;
use App\Services\ServiceAbstract;
use Illuminate\Database\Eloquent\Collection;
use Exception;
use Illuminate\Database\Eloquent\Model;

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
     * @param name $name
     * @return ?Collection
    */
    public function index(string $restaurant = null, string $item = null) : ?Collection
    {
        try
        {
            $restaurants = Restaurant::with(
                [
                    'gastronomy',
                    'restaurant_type',
                    'address',
                    'owner'
                ]
            )->withWhereHas('menus.itens', function($query) use($item) {
                if(isset($item)){
                    $query->where('name', 'like', "%{$item}%");
                    $query->orWhere('description', 'like', "%{$item}%");
                }
            });;


            // Global Filters
            if(isset($restaurant))
            {
                $restaurants->where('name', 'like', "%{$restaurant}%");
            }

            return $restaurants->get();

        }catch(Exception $e)
        {
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return ?Model
     */
    public function findBy($id) : ?Model
    {
        return Restaurant::with(['gastronomy', 'menus', 'address'])->find($id);
    }


}
