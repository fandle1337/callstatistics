<?php

namespace App\Dto;

class DtoTableRow
{
    public function __construct(
        public ?int    $id = null,
        public ?string $name = null,
        public ?int    $totalCalls = null,
        public ?int    $incomingCalls = null,
        public ?int    $outgoingCalls = null,
        public ?int    $missedCalls = null,
        public ?int    $totalDuration = null,
        public ?int    $averageDuration = null,
        public ?int    $cost = null,
    )
    {
    }
}
