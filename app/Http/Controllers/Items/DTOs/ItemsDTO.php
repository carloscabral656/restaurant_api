<?php

namespace App\Http\Controllers\Items\DTOs;

use App\Http\Sales\DTOs\SalesDTO;
use App\Models\Item;

class ItemsDTO {

    protected SalesDTO $salesDTO;

    public function __construct() {
        $this->salesDTO = app(SalesDTO::class);
    }

    public function createDTO(Item $i): array
    {
        return [
            "name" => $i->name,
            "description" => $i->description,
            "img_item"    => asset("/itens/{$i->img_item}"),
            "unit_price"  => $i->unit_price,
            "sale" => $this->salesDTO->createDTO($i->sale)
        ];
    }
}
