<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = "purchases";
    protected $fillable = ["id", "id_user", "total_descount", "total_purchase"];
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
