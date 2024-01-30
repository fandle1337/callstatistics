<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceGraphStatistics extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        foreach ($this->resource as $month) {
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
