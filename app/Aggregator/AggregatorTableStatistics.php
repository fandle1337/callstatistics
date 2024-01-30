<?php

namespace App\Aggregator;

use App\Dto\DtoRestUser;
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

        $idList = $this->getIdList($tableData);

        $nameList = $this->repositoryRestUser->getByListId($idList);

        $mappedNameList = $this->mapNameList($nameList);

        foreach ($tableData as $row) {
            $result[] = new DtoTableRow(
                id: $row->id,
                name: $mappedNameList[$row->id] ?? 'Имя недоступно',
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

    protected function getIdList(array $tableData): array
    {
        /** @var DtoTableRow[] $tableData */
        foreach ($tableData as $row) {
            $idList[] = $row->id;
        }
        if (empty($idList)) {
            return [];
        }
        return $idList;
    }

    /**
     * @param DtoRestUser[] $nameList
     * @return array
     */
    protected function mapNameList(array $nameList): array
    {
        foreach ($nameList as $name) {
            $result[$name->id] = $name->name . ' ' . $name->lastName;
        }
        return $result ?? [];
    }
}
