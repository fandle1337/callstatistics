<?php

namespace App\Interface\Storage;

use App\Dto\DtoPortal;

interface InterfaceRepositoryPortal
{
    public function addOrUpdate(DtoPortal $dtoPortal);

    public function getByMemberId(string $memberId): bool|DtoPortal;

    public function uninstallByMemberId(string $memberId): bool;
    public function getActiveClients(): array;
}
