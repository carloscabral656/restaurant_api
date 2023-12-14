<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluations';
    protected $fillable = [
        'id_purchase',
        'id_restaurant',
        'evaluation',
        'comment'
    ];
}
