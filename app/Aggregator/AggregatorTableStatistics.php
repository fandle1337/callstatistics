<?php

namespace App\Aggregator;

use App\Dto\DtoTableRow;
use App\Interface\Rest\InterfaceRepositoryRestUser;
use App\Interface\Storage\InterfaceRepositoryCall;

class AggregatorTableStatistics
{
    public function __construct(
        protected InterfaceRepositoryCall     $repositoryCall,
        protected InterfaceRepositoryRestUser $repositoryRestUser,
    )
    {
    }

    public function make(int $portalId, array $date): array
    {
        $tableData = $this->repositoryCall->getTableStatistics($portalId, $date);

        /** @var DtoTableRow[] $tableData */
        foreach ($tableData as $row) {
            $idList[] = $row->id;
        }
        if (empty($idList)) {
            return [];
        }

        $tableNames = $this->repositoryRestUser->getByListId($idList);

        foreach ($tableNames as $user) {
            $userName[$user->id] = $user->name . ' ' . $user->lastName;
        }
        foreach ($tableData as $row) {
            $result[] = new DtoTableRow(
                id: $row->id,
                name: $userName[$row->id] ?? 'Имя недоступно',
                totalCalls: $row->totalCalls,
                incomingCalls: $row->incomingCalls,
                outgoingCalls: $row->outgoingCalls,
                missedCalls: $row->missedCalls,
                totalDuration: $row->totalDuration,
                averageDuration: $row->totalCalls > 0 ? $row->totalDuration / $row->totalCalls : 0,
                cost: $row->cost,
            );
        }
        return $result ?? [];
    }
}
