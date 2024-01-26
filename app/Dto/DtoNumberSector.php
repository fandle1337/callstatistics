<?php

namespace App\Dto;

class DtoNumberSector
{
    public function __construct(
        public ?string $name = null,
        public ?int $count = null,
    )
    {
    }
}
