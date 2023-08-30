<?php

namespace App\Http\Controllers\Purchases\DTOs;

use App\Http\Controllers\Items\DTOs\ItemsDTO;
use App\Http\Controllers\Users\DTOs\UserDTO;
use App\Models\Purchase;
use App\Models\User;

class PurchaseDTO {
    protected ItemsDTO $itemDTO;
    protected UserDTO  $userDTO;

    public function __construct(){
        $this->itemDTO = app(ItemsDTO::class);
        $this->userDTO = app(UserDTO::class);
    }

    public function createDTO(Purchase $p){
        return [
            "id"     => $p->id, 
            "client" => $this->userDTO->createDTO($p->client),
            "totalGrossPurchase" => $p->total_gross_purchase, 
            "descountPurchase"   => $p->descount_purchase,
            "totalDescountItems" => $p->total_descount_items,
            "totalNetPurchase"   => $p->total_net_purchase,
            "items"  => $p->items->map(function($i){
                return $this->itemDTO->createDTO($i);
            })
        ];
    }
}