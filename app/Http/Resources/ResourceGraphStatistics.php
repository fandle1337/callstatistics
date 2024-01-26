<?php

namespace App\Http\Resources;

use App\Dto\DtoGraphMonth;

class ResourceGraphStatistics
{
    /**
     * @param DtoGraphMonth[] $graphData
     * @return array
     */
    public static function toArray(array $graphData): array
    {
        foreach ($graphData as $month) {
            $result[] = [
                'date' => $month->date,
                'incoming' => $month->incomingCalls,
                'outgoing' => $month->outgoingCalls,
                'missed' => $month->missedCalls,
            ];
        }
        return $result ?? [];
    }
}
