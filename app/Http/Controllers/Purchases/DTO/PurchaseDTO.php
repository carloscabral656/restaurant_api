<?php

namespace App\Controllers\Purchases\DTO;

use App\Http\Controllers\Items\DTOs\ItemsDTO;
use App\Models\Purchase;

class PurchaseDTO {
    protected ItemsDTO $item;

    public function __construct(){
        $this->item = app(ItemsDTO::class);
    }

    public function createDTO(Purchase $p){
        return [
            "id" => $p->id, 
            "id_user" => $p->id_user, 
            "total_descount" => $p->total_descount, 
            "total_purchase"  => $p->total_purchase
        ];
    }
}