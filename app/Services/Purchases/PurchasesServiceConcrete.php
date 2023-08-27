<?php

namespace App\Services\Purchases;

use App\Models\Item;
use App\Models\Purchase;
use App\Services\ServiceAbstract;
use Exception;
use Illuminate\Support\Facades\DB;

class PurchasesServiceConcrete extends ServiceAbstract {

    protected Item $itemsModel;

    public function __construct(Purchase $purchase)
    {
        parent::__construct($purchase);
        $this->itemsModel = app(Item::class);
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
            $totalDescountItems = $this->calculateTotalDescountItems($purchase);
            $totalPurchase = $this->calculateTotalPurchase($purchase);
            DB::beginTransaction();
            $purchaseData = [
                "id_user"              => $purchase["id_user"], 
                "total_descount_items" => $totalDescountItems, 
                "descount_purchase"    => 0,    
                "total_gross_purchase" => $totalPurchase, 
                "total_net_purchase"   => ($totalPurchase - $totalDescountItems)
            ];
            $purchase = $this->model->create($purchaseData);
            DB::commit();
            return $purchase;
        }catch(Exception $e){
            return $e->getMessage();
            DB::rollBack();
        }
    }

    /**
     * Calculate the sum of all descounts this item has.
     * 
    */
    public function calculateTotalDescountItems(array $purchase){
        $items = $this->itemsModel
                    ->whereIn('id', $purchase["items"])
                    ->get();
        $totalDescount = $items->reduce(function($sum, $item){
            return $sum + (($item->discount/100) * $item->unit_price);
        }, 0);
        return $totalDescount;
    }

    /**
     * 
     * Calculate the sum of the price all items
     * 
    */
    public function calculateTotalPurchase(array $purchase){
        $items = $this->itemsModel
                    ->whereIn('id', $purchase["items"])
                    ->get();
        $totalPurchase = $items->reduce(function($sum, $item){
            return $sum + $item->unit_price;
        }, 0);
        return $totalPurchase;
    }

}