<?php

namespace App\Interface\Rest;

interface InterfaceRepositoryRestCall
{
    public function getTotal(): int;

    public function getLastId(): int;

    public function getCallsByPortalId(int $currentCallId, int $lastCallId, int $portalId, int $limit): array;

}
