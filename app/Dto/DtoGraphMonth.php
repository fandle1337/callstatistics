<?php

namespace App\Dto;

class DtoGraphMonth
{
    public function __construct(
        public ?int $date = null,
        public ?int $incomingCalls = null,
        public ?int $outgoingCalls = null,
        public ?int $missedCalls = null,
    )
    {
    }
}
