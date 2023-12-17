<?php

namespace App\Http\Controllers\Restaurants\DTOs;

use App\Http\Controllers\Addresses\DTOs\AddressesDTO;
use App\Http\Controllers\Gastronomies\DTOs\GastronomiesDTO;
use App\Http\Controllers\Menus\DTOs\MenuDTO;
use App\Http\Controllers\RestaurantsType\DTOs\RestaurantsTypeDTO;
use App\Http\Controllers\Users\DTOs\UserDTO;
use App\Models\Menu;
use App\Models\Restaurant;

class RestaurantsDTO
{
    protected Restaurant $restaurant;

    public function __construct(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    public function createDTO(): array
    {
        $dataMustPresent = [];
        $currentAttributes = $this->restaurant->getAttributes();

        if(array_key_exists('id', $currentAttributes))
        {
            $dataMustPresent['id'] = $this->restaurant->id;
        }

        if(array_key_exists('name', $currentAttributes))
        {
            $dataMustPresent['name'] = $this->restaurant->name;
        }

        if(array_key_exists('description', $currentAttributes))
        {
            $dataMustPresent['description'] = $this->restaurant->description;
        }

        if(array_key_exists('img_restaurant', $currentAttributes))
        {
            $dataMustPresent['img_restaurant'] = asset($this->restaurant->image_restaurant);
        }

        if($this->restaurant->relationLoaded('gastronomy'))
        {
            $gastronomy = (new GastronomiesDTO($this->restaurant->gastronomy))->createDTO();
            $dataMustPresent['gastronomy'] = $gastronomy;
        }

        if($this->restaurant->relationLoaded('restaurant_type'))
        {
            $restaurantType = (new RestaurantsTypeDTO($this->restaurant->restaurant_type))->createDTO();
            $dataMustPresent['restaurant_type'] = $restaurantType; 
        }

        if($this->restaurant->relationLoaded('address'))
        {
            $address = (new AddressesDTO($this->restaurant->address))->createDTO();
            $dataMustPresent['address'] = $address;
        }

        if($this->restaurant->relationLoaded('owner'))
        {
            $owner = (new UserDTO($this->restaurant->owner))->createDTO();
            $dataMustPresent['owner'] = $owner;
        }

        if($this->restaurant->relationLoaded('purchases')){
            $dataMustPresent['purchases'] = $this->restaurant->purchases;
        }

        
        if($this->restaurant->relationLoaded('menus'))
        {
            $menus = $this->restaurant?->menus?->map(function(Menu $menu) {
                return (new MenuDTO($menu))->createDTO();
            });
            $dataMustPresent['menus'] = $menus;
        }
        

        $dataMustPresent['evaluation'] = $this->restaurant->evaluationAvg();
        
        return $dataMustPresent;
    }
}
