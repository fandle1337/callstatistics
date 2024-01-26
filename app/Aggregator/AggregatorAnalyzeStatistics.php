<?php

namespace App\Aggregator;

use App\Interface\Rest\InterfaceRepositoryRestCall;
use App\Interface\Storage\InterfaceRepositoryCall;

class AggregatorAnalyzeStatistics
{
    public function __construct(
        protected InterfaceRepositoryCall     $repositoryCall,
        protected InterfaceRepositoryRestCall $repositoryRestCall,
    )
    {
    }

    public function make(int $portalId): array
    {
        $totalCallsFromRest = $this->repositoryRestCall->getTotal();
        $totalCallsFromStorage = $this->repositoryCall->getTotalByPortalId($portalId);
        return [
            'totalCallsFromRest'    => $totalCallsFromRest,
            'totalCallsFromStorage' => $totalCallsFromStorage,
        ];
    }
}
