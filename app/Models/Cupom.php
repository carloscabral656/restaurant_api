<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    protected $table = "cupons";
    protected $fillable = [
        "name",
        "description",
        "initial_date",
        "expiration_date",
        "percentage_descount",
    ];
}
