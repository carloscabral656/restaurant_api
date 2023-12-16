<?php

namespace App\Http\Controllers\Addresses\DTOs;

use App\Models\Address;

class AddressesDTO
{

    private Address $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function createDTO(): array
    {
        return [
            'id'      => $this->address->id,
            "address" => $this->address->address,
            "neighborhood" => $this->address->neighborhood,
            "number"    => $this->address->number,
            "city"      => $this->address->city,
            "state"     => $this->address->state
        ];
    }

    public function createAddressAsString(): string
    {
        return "{$this->address->address} - {$this->address->neighborhood}, N {$this->address->number}, {$this->address->city} - {$this->address->state}";
    }
}
