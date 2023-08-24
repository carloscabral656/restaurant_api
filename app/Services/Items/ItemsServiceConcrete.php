<?php

namespace App\Services\Items;

use App\Models\Item;
use App\Services\ServiceAbstract;

class ItemsServiceConcrete extends ServiceAbstract
{
    protected Item $model;

    public function __construct(Item $model)
    {
       $this->model = $model; 
    }

}
