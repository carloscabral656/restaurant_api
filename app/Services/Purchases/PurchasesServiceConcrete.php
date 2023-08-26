<?php

namespace App\Services\Purchases;

use App\Models\Purchase;
use App\Services\ServiceAbstract;

class PurchasesServiceConcrete extends ServiceAbstract {

    public function __construct(Purchase $purchase)
    {
        parent::__construct($purchase);
    }

}