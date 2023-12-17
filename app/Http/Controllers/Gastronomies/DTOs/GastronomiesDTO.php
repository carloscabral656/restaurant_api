<?php

namespace App\Http\Controllers\Gastronomies\DTOs;

use App\Models\Gastronomy;

class GastronomiesDTO {

    private Gastronomy $gastronomy;

    public function __construct(Gastronomy $gastronomy)
    {
        $this->gastronomy = $gastronomy;
    }

    public function createDTO(): array 
    {
        return [
            "id"          => $this->gastronomy->id,
            "img_gastronomy" => asset($this->gastronomy->img_gastronomy),
            "description" => $this->gastronomy->description
        ];
    }

}
