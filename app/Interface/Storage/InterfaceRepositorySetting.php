<?php

namespace App\Interface\Storage;

interface InterfaceRepositorySetting
{
    public function addOrUpdateValueByCodeAndPortalId(int $portalId, string $code, int $value): bool;
    public function deleteByPortalId(int $portalId): bool;
    public function getValueByCodeAndPortalId(int $portalId, string $code): int;
}
