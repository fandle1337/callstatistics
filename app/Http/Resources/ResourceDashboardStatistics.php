<?php

namespace App\Http\Resources;

use App\Dto\DtoDashboardStatistics;

class ResourceDashboardStatistics
{
    public static function toArray(DtoDashboardStatistics $dto): array
    {
        return [
            'totalCalls'    => [
                'count'   => $dto->totalCount,
                'seconds' => $dto->totalSeconds,
            ],
            'incomingCalls' => [
                'count'   => $dto->incomingCount,
                'seconds' => $dto->incomingSeconds,
            ],
            'outgoingCalls' => [
                'count'   => $dto->outgoingCount,
                'seconds' => $dto->outgoingSeconds,
            ],
            'missedCalls'   => $dto->missedCount,
            'cost'          => $dto->costs,
        ];
    }
}
