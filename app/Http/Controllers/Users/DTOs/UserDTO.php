<?php

namespace App\Http\Controllers\Users\DTOs;

use App\Http\Controllers\Addresses\DTOs\AddressesDTO;
use App\Models\User;

class UserDTO {

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createDTO(): array 
    {
        return [
            "id"   => $this->user->id,
            "name" => $this->user->name,
            "email" => $this->user->email,
            "roles" => [],
            "address" => (new AddressesDTO($this->user->address))->createDTO()
        ];
    }

    public function createUserDTOAsOwner()
    {
        return $this->user->name;
    }
}
