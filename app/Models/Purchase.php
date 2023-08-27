<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = "purchases";
    protected $fillable = [
        "id_user", 
        "total_descount_items", // The sum of all descount in items.
        "descount_purchase",    // Discount in Purchase
        "total_gross_purchase", // The sum of all full value in items.
        "total_net_purchase"    // total_gross_purchase - total_descount_items - descount_purchase
        ]; 
    protected $with = ['client', 'items'];

    public function client(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function items(){
        return $this->belongsToMany(
            Item::class, 
            ItemPurchase::class,
            'id_purchase',
            'id_item'
        );
    }

}
