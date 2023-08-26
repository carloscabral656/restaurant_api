<?php

namespace App\Services\Purchases;

use App\Models\Purchase;
use App\Services\ServiceAbstract;
use Exception;
use DB;
use Illuminate\Support\Facades\DB;

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
        try{
            // TODO: Create logic for descount.

            // TODO: Create logic for total price for a purchase.
            DB::beginTransaction();
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
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
    public function calculateTotalPurchase(){
    }

}