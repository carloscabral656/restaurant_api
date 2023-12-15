<?php

namespace App\Http\Controllers\Users\DTOs;

use App\Models\User;

class UserDTO {

    public function __construct(){
    }

    public function createDTO(User $user): array {
        return [
            "id"   => $user->id,
            "name" => $user->name
        ];
    }
}
