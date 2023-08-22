<?php

namespace App\Http\Controllers\Gastronomies\DTOs;

use App\Models\Gastronomy;

class GastronomiesDTO {

    protected Gastronomy $gastronomy;

    public function __construct()
    {
        $this->gastronomy  = app(Gastronomy::class);
    }

    public function createDTO(Gastronomy $gastronomy){
        return [
            "id"          => $gastronomy->id,
            "description" => $gastronomy->description
        ];
    }

}
