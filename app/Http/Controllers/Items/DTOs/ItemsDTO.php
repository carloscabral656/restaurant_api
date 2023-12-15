<?php

namespace App\Http\Controllers\Items\DTOs;

use App\Models\Item;

class ItemsDTO {

    public function __construct(){
    }

    public function createDTO(Item $i): array
    {
        return [
            'id'      => $i->id,
            'name'    => $i->name
        ];
    }
}
