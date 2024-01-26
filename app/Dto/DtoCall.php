<?php

namespace App\Dto;

class DtoCall
{

    public function __construct(
        public ?int    $id = null,
        public ?int    $portalId = null,
        public ?int    $userId = null,
        public ?int    $callId = null,
        public ?string $portalNumber = null,
        public ?int    $duration = null,
        public ?string $date = null,
        public ?float  $cost = null,
        public ?string $costCurrency = null,
        public ?int    $typeId = null,
        public ?int    $codeId = null,
    )
    {
    }
}
