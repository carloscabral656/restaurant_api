<?php

namespace App\Http\Controllers\Menus\DTOs;

use App\Models\Menu;

class MenuDTO {
    protected Menu $menu;

    public function __construct(){
    }

    public function createDTO(Menu $m){
        return [
            'id'   => $m->id,
            'name' => $m->name,
            'itens' => $m->itens
        ];
    }
}