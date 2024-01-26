<?php

namespace App\Aggregator;

use App\Dto\DtoDashboardStatistics;
use App\Interface\Storage\InterfaceRepositoryCall;

class AggregatorDashboardStatistics
{
    public function __construct(
        protected InterfaceRepositoryCall $repositoryCall,
    )
    {
    }

    public function make(int $portalId, array $date): DtoDashboardStatistics
    {
        $totalCount = $this->repositoryCall->getCountForTotalCalls($portalId, $date);

        $totalSeconds = $this->repositoryCall->getSecondsForTotalCalls($portalId, $date);

        $incomingCount = $this->repositoryCall->getCountForIncomingCalls($portalId, $date);

        $incomingSeconds = $this->repositoryCall->getSecondsForIncomingCalls($portalId, $date);

        $outgoingCount = $this->repositoryCall->getCountForOutgoingCalls($portalId, $date);

        $outgoingSeconds = $this->repositoryCall->getSecondsForOutgoingCalls($portalId, $date);

        $missedCount = $this->repositoryCall->getCountForMissedCalls($portalId, $date);

        $costs = $this->repositoryCall->getCountAndCurrencyForCosts($portalId, $date);

        return new DtoDashboardStatistics(
            totalCount: $totalCount,
            totalSeconds: $totalSeconds,
            incomingCount: $incomingCount,
            incomingSeconds: $incomingSeconds,
            outgoingCount: $outgoingCount,
            outgoingSeconds: $outgoingSeconds,
            missedCount: $missedCount,
            costs: $costs,
        );

    }
}
