<?php

namespace App\Http\Controllers\Gastronomies\DTOs;

use App\Models\Gastronomy;

class GastronomiesDTO {

    public function createDTO(Gastronomy $gastronomy){
        return [
            "id"          => $gastronomy->id,
            "description" => $gastronomy->description
        ];
    }

}
