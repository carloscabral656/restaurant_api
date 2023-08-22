<?php

namespace App\Services\Roles;

use App\Models\Roles;
use App\Services\ServiceAbstract;
use Illuminate\Database\Eloquent\Model;

class RolesServiceConcrete extends ServiceAbstract{

    protected Model $model;

    public function __construct(Roles $roles)
    {
        $this->model = $roles;
    }

}