<?php

namespace App\Http\Controllers\Users\DTOs;

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
            "name" => $this->user->name
        ];
    }

    public function createUserDTOAsOwner()
    {
        return $this->user->name;
    }
}
