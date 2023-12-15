<?php

namespace App\Http\Controllers\Menus\DTOs;

use App\Http\Controllers\Items\DTOs\ItemsDTO;
use App\Models\Item;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class MenuDTO {
    protected ItemsDTO $itemsDTO;

    public function __construct(){
        $this->itemsDTO = app(ItemsDTO::class);
    }

    public function createDTO(Menu $menu) : array
    {
        return [
            'id'   => (int)$menu->id,
            'name' => $menu->name,
            'discription' => $menu->description,
            'itens' => $menu->itens?->map(function($item){
                return $this->itemsDTO?->createDTO($item);
            })->toArray()
        ];
    }
}
