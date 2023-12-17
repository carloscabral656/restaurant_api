<?php

namespace App\Http\Controllers\Items\DTOs;

use App\Http\Controllers\Sales\DTOs\SalesDTO;
use App\Models\Item;

class ItemsDTO {

    private Item $item;

    public function __construct(Item $item) 
    {
        $this->item = $item;
    }

    public function createDTO(): array
    {

        $sale = (new SalesDTO($this->item->sale))->createDTO();

        return [
            "id"          =>$this->item->id,
            "name"        => $this->item->name,
            "description" => $this->item->description,
            "img_item"    => asset("/itens/{$this->item->img_item}"),
            "type_item"   => $this->item->type_item,
            "unit_price"  => $this->item->unit_price,
            "sale"        => $sale
        ];
    }
}
