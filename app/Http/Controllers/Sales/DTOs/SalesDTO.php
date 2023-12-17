<?php

namespace App\Http\Controllers\Sales\DTOs;

use App\Models\Sale;

class SalesDTO
{

    private Sale $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function createDTO(): array
    {
        return [
            "name"        => $this->sale->name,
            "description" => $this->sale->description,
            "discount"    => $this->sale->discount,
            "begin_at"    => $this->sale->begin_at,
            "end_at"      => $this->sale->end_at,
            "active"      => $this->sale->isActive()
        ];
    }
}
