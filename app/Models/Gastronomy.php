<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gastronomy extends Model
{
    use HasFactory;

    protected $table = "gastronomies";
    protected $primaryKey = "id";
    protected $fillable = ["description", "img_gastronomy"];

    public function restaurants(){
        return $this->belongsTo(Restaurant::class, 'id_gastronomy', 'id');
    }
}
