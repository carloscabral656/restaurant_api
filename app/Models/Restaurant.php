<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = "restaurants";
    protected $primaryKey = 'id_gastronomy';
    protected $fillable = ["name", "description", "id_gastronomy", "id_restaurant_type", "id_owner", "id_address"];
    protected $with = ['gastronomy'];

    public function gastronomy(){
        return $this->hasOne(Gastronomy::class, 'id', 'id_gastronomy');
    }
}
