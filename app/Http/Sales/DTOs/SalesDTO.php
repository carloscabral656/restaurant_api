<?php

namespace App\Http\Sales\DTOs;

use App\Models\Sale;
use Carbon\Carbon;

class SalesDTO
{
    public function __construct()
    {
    }

    public function createDTO(Sale $sale): array
    {
        return [
            "id"       => $sale->description,
            "discount" => $sale->discount,
            "active"   => function() use($sale) {
                $today = Carbon::now();
                $begin = Carbon::createFromTimestamp($sale->begin_at);
                $finish = Carbon::createFromTimestamp($sale->finish);
                return $today->between($begin, $finish);
            }
        ];
    }
}
