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
            "name"        => $sale->name,
            "description" => $sale->description,
            "discount"    => $sale->discount,
            "begin_at"    => $sale->begin_at,
            "end_at"      => $sale->end_at,
            "active"      => $sale->isActive()
        ];
    }
}
