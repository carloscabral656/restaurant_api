<?php

namespace App\Http\Controllers\Cupons\DTOs;

use App\Models\Cupom;

class CuponsDTO
{
    public function __construct(){
    }

    public function createDTO(Cupom $c){
        return [
            "id" => $c->id,
            "name" => $c->name,
            "description" => $c->description,
            "initial_date" => $c->initial_date,
            "expiration_date" => $c->expiration_date,
            "percentage_descount" => $c->percentage_descount,
        ];
    }
}
