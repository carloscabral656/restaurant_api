<?php

namespace App\Services\Cupoms;

use App\Models\Cupom;
use App\Services\ServiceAbstract;
use Illuminate\Database\Eloquent\Model;

class CupomsServiceConcrete extends ServiceAbstract
{
    public function __construct(Cupom $cupom)
    {
        parent::__construct($cupom);
    }
}
