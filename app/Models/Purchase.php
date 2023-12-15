<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Purchase extends Model
{
    use HasFactory;

    protected $table = "purchases";

    protected $fillable = [
        "id_user",
        "id_restaurant",
        "total_descount_items", // The sum of all descount in items.
        "descount_purchase",    // Discount in Purchase
        "total_gross_purchase", // The sum of all full value in items.
        "total_net_purchase"    // total_gross_purchase - total_descount_items - descount_purchase
    ];

    protected $with = ['evaluation'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, ItemPurchase::class, 'id_purchase', 'id_item');
    }

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class, 'id_purchase', 'id');
    }

}
