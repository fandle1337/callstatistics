<?php

namespace App\Interface\Storage;

use App\Dto\DtoCall;

interface InterfaceRepositoryCall
{
    public function getCountForTotalCalls(int $portalId, array $date): int;

    public function getSecondsForTotalCalls(int $portalId, array $date): int;

    public function getCountForIncomingCalls(int $portalId, array $date): int;

    public function getSecondsForIncomingCalls(int $portalId, array $date): int;

    public function getCountForOutgoingCalls(int $portalId, array $date): int;

    public function getSecondsForOutgoingCalls(int $portalId, array $date): int;

    public function getCountForMissedCalls(int $portalId, array $date): int;

    public function getCountAndCurrencyForCosts(int $portalId, array $date): array;

    public function getGraphStatistics(int $portalId, array $date): bool|array;

    public function getResponsibleStatistics(int $portalId, array $date): bool|array;

    public function getNumberStatistics(int $portalId, array $date): bool|array;

    public function getTableStatistics(int $portalId, array $date): bool|array;

    public function getTotalByPortalId(int $portalId): int;

    public function deleteAllByPortalId(int $portalId): bool;

    public function add(DtoCall $dtoCall): bool;

    public function isHasByPortalId(array $callIdList, int $portalId): array;
}
