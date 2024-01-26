<?php

namespace App\Dto;

class DtoCost
{

    public function __construct(
        public ?int    $count = null,
        public ?string $currency = null,
    )
    {
    }
}
