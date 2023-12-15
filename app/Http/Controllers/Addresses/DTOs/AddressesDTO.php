<?php

namespace App\Http\Controllers\Addresses\DTOs;

use App\Models\Address;

class AddressesDTO
{
    public function __construct()
    {
    }

    public function createDTO(Address $a): array
    {
        return [
            'id'      => $a->id,
            "address" => $a->address,
            "neighborhood" => $a->neighborhood,
            "number"    => $a->number,
            "city"      => $a->city,
            "state"     => $a->state
        ];
    }
}
