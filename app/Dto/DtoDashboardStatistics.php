<?php

namespace App\Dto;

class DtoDashboardStatistics
{
    public function __construct(
        public ?int   $totalCount = null,
        public ?int   $totalSeconds = null,
        public ?int   $incomingCount = null,
        public ?int   $incomingSeconds = null,
        public ?int   $outgoingCount = null,
        public ?int   $outgoingSeconds = null,
        public ?int   $missedCount = null,
        public ?array $costs = null,
    )
    {
    }
}
