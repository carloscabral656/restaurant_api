<?php

namespace App\Http\Controllers\Gastronomies\DTOs;

use App\Models\Gastronomy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GastronomiesDTO {

    protected Gastronomy $gastronomy;

    public function __construct(Gastronomy $gastronomy)
    {
        $this->gastronomy  = $gastronomy;
    }
    
    public function createDTO(){
        return [
            "id"          => $this->gastronomy->id,
            "description" => $this->gastronomy->description
        ];
    }

}