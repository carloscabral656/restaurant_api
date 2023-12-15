<?php

namespace App\Http\Controllers\Menus\DTOs;

use App\Http\Controllers\Items\DTOs\ItemsDTO;
use App\Models\Item;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class MenuDTO {
    protected ItemsDTO $ItemsDTO;

    public function __construct(){
        $this->ItemsDTO = app(ItemsDTO::class);
    }

    public function createDTO(Collection $menus) : array
    {

        $menus = $menus->map(function(Menu $menu): array
        {
            return [
                'id'    => $menu->id,
                'name'  => $menu->name,
                'itens' => $this->ItemsDTO?->createDTO($menu->itens)
            ];
        });

        return $menus->toArray();
    }
}
