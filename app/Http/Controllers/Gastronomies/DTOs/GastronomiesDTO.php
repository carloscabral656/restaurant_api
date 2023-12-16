<?php

namespace App\Http\Controllers\Gastronomies\DTOs;

use App\Models\Gastronomy;

class GastronomiesDTO {

    private Gastronomy $gastronomy;

    public function __construct(Gastronomy $gastronomy)
    {
        $this->gastronomy = $gastronomy;
    }

    public function createDTO(): string 
    {
        return $this->gastronomy->description;
    }

}
