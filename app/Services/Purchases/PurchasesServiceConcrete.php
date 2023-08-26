<?php

namespace App\Services\Purchases;

use App\Models\Purchase;
use App\Services\ServiceAbstract;
use Illuminate\Http\Request;

class PurchasesServiceConcrete extends ServiceAbstract {

    public function __construct(Purchase $purchase)
    {
        parent::__construct($purchase);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  array $purchase
     *
     * @return
     */
    public function store(array $purchase){
        return $purchase;
    }

    /**
     * Calculate the sum of all descounts this item has.
     * 
    */
    public function calculateTotalDescount(){
    }

    /**
     * 
     * Calculate the sum of the price all items
     * 
    */
    public function calculateTotalPurnchase(){
    }

}