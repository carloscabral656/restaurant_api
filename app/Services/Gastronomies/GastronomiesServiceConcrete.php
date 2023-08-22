<?php

namespace App\Services\Gastronomies;

use App\Models\Gastronomy;
use App\Services\ServiceAbstract;

class GastronomiesServiceConcrete extends ServiceAbstract {

    public function __construct(Gastronomy $gastronomies)
    {
        $this->model = $gastronomies;
    }

}