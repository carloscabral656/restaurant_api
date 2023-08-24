<?php

namespace App\Services\Menus;

use App\Models\Menu;
use App\Services\ServiceAbstract;
use Illuminate\Database\Eloquent\Collection;

class MenuServiceConcrete extends ServiceAbstract {

    public function __construct(Menu $menuModel)
    {
        parent::__construct($menuModel);
    }

}