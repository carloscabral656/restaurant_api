<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = "purchases";
    protected $fillable = ["id", "id_user", "id_item"];
    protected $with = ['client'];

    public function client(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function items(){
    }

}
