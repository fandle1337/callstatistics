<?php

namespace App\Dto;

class DtoFilter
{
    public function __construct(
        public ?int $year = null,
        public ?int $quarter = null,
    )
    {
    }
}
