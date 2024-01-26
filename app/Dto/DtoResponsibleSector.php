<?php

namespace App\Dto;

class DtoResponsibleSector
{
    public function __construct(
        public ?int    $id = null,
        public ?string $name = null,
        public ?int    $count = null,
    )
    {
    }
}
