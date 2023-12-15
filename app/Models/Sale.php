<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'name',
        'description',
        'discount',
        'begin_at',
        'end_at'
    ];

    public function isActive(): bool
    {
        $today = Carbon::now();
        $begin = Carbon::create($this->begin_at);
        $end = Carbon::create($this->end_at);
        return $today->between($begin, $end);
    }
}
