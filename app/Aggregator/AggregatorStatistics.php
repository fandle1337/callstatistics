<?php

namespace App\Aggregator;

use App\Helper\HelperQuarterDate;
use App\Http\Resources\ResourceDashboardStatistics;
use App\Http\Resources\ResourceGraphStatistics;
use App\Interface\Storage\InterfaceRepositoryCall;
use App\Interface\Storage\InterfaceRepositoryPortal;
use Sw24\Bitrix24Auth\Dto\DtoAuth;

class AggregatorStatistics
{
    public function __construct(
        protected DtoAuth                         $dtoAuth,
        protected InterfaceRepositoryPortal       $repositoryPortal,
        protected InterfaceRepositoryCall         $repositoryCall,
        protected AggregatorResponsibleStatistics $aggregatorResponsibleStatistics,
        protected AggregatorTableStatistics       $aggregatorTableStatistics,
        protected AggregatorDashboardStatistics   $aggregatorDashboardStatistics,
        protected AggregatorAnalyzeStatistics     $aggregatorAnalyzeStatistics,
    )
    {
    }

    public function make(int $quarter, int $year): array
    {
        $dtoPortal = $this->repositoryPortal->getByMemberId($this->dtoAuth->memberId);
        $date = HelperQuarterDate::get($quarter, $year);

        $dashboard = $this->aggregatorDashboardStatistics->make($dtoPortal->id, $date);
        $graph = $this->repositoryCall->getGraphStatistics($dtoPortal->id, $date);
        $responsible = $this->aggregatorResponsibleStatistics->make($dtoPortal->id, $date);
        $number = $this->repositoryCall->getNumberStatistics($dtoPortal->id, $date);
        $table = $this->aggregatorTableStatistics->make($dtoPortal->id, $date);
        $analyze = $this->aggregatorAnalyzeStatistics->make($dtoPortal->id);

        return [
            'dashboard_stats'   => new ResourceDashboardStatistics($dashboard),
            'graph_stats'       => new ResourceGraphStatistics($graph),
            'responsible_stats' => $responsible,
            'number_stats'      => $number,
            'table_stats'       => $table,
            'analyze_stats'     => $analyze,
        ];
    }
}
