<?php

namespace App\Interface\Storage;

interface InterfaceRepositoryPortalSetting
{
    public function addOrUpdateValueByCode(int $portalId, string $code, mixed $value): bool;
    public function deleteAll(int $portalId): bool;
    public function getValueByCode(int $portalId, string $code): int;
}
