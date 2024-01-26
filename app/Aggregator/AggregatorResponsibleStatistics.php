<?php

namespace App\Aggregator;

use App\Dto\DtoResponsibleSector;
use App\Interface\Rest\InterfaceRepositoryRestUser;
use App\Interface\Storage\InterfaceRepositoryCall;

class AggregatorResponsibleStatistics
{
    public function __construct(
        protected InterfaceRepositoryCall     $repositoryCall,
        protected InterfaceRepositoryRestUser $repositoryRestUser,
    )
    {
    }

    public function make(int $portalId, array $date): array
    {
        $responsibleData = $this->repositoryCall->getResponsibleStatistics($portalId, $date);

        /** @var DtoResponsibleSector[] $responsibleData */
        foreach ($responsibleData as $row) {
            $idList[] = $row->id;
        }
        if (empty($idList)) {
            return [];
        }

        $responsibleNames = $this->repositoryRestUser->getByListId($idList);

        foreach ($responsibleNames as $user) {
            $userName[$user->id] = $user->name . ' ' . $user->lastName;
        }

        foreach ($responsibleData as $row) {
            $result[] = new DtoResponsibleSector(
                id: $row->id,
                name: $userName[$row->id] ?? 'Имя недоступно',
                count: $row->count,
            );
        }
        return $result ?? [];
    }
}
