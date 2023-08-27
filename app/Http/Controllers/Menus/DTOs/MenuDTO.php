<?php

namespace App\Http\Controllers\Menus\DTOs;

use App\Http\Controllers\Items\DTOs\ItemsDTO;
use App\Models\Menu;

class MenuDTO {
    protected ItemsDTO $item;

    public function __construct(){
        $this->item = app(ItemsDTO::class);
    }

    public function createDTO(Menu $m){
        $itens = $m->itens->map(function($i){
            return (new ItemsDTO())->createDTO($i);
        });
        return [
            'id'    => $m->id,
            'name'  => $m->name,
            'itens' => $itens
        ];
    }
}