<?php

namespace App\Http\Controllers\Addresses;

use App\Http\Controllers\ControllerAbstract;
use App\Models\Address;

class AddressController extends ControllerAbstract
{
    public function __construct(Address $model)
    {
        parent::__construct($model);
    }
}
