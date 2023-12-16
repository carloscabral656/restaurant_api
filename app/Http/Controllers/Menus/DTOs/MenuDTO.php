<?php

namespace App\Http\Controllers\Menus\DTOs;

use App\Http\Controllers\Items\DTOs\ItemsDTO;
use App\Models\Menu;

class MenuDTO {
    
    private Menu $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function createDTO() : array
    {
        $itens =  $this->menu->itens?->map(function($item): array {
            $item = (new ItemsDTO($item))->createDTO();
            return $item;
        });
        return [
            'id'   => (int)$this->menu->id,
            'name' => (string)$this->menu->name,
            'description' => (string)$this->menu->description,
            'itens' => (array)$itens
        ];
    }
}
