<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceDashboardStatistics extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'totalCalls'    => [
                'count'   => $this->totalCount,
                'seconds' => $this->totalSeconds,
            ],
            'incomingCalls' => [
                'count'   => $this->incomingCount,
                'seconds' => $this->incomingSeconds,
            ],
            'outgoingCalls' => [
                'count'   => $this->outgoingCount,
                'seconds' => $this->outgoingSeconds,
            ],
            'missedCalls'   => $this->missedCount,
            'cost'          => $this->costs,
        ];
    }
}
