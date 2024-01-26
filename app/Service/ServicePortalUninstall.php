<?php

namespace App\Service;

use App\Interface\Storage\InterfaceRepositoryCall;
use App\Interface\Storage\InterfaceRepositoryPortal;
use App\Interface\Storage\InterfaceRepositorySetting;

class ServicePortalUninstall
{
    public function __construct(
        protected InterfaceRepositoryPortal $repositoryPortal,
        protected InterfaceRepositoryCall $repositoryCall,
        protected InterfaceRepositorySetting $repositorySetting,
    )
    {
    }

    public function uninstall(string $memberId): bool
    {
        $dtoPortal = $this->repositoryPortal->getByMemberId($memberId);

        $this->repositorySetting->deleteByPortalId($dtoPortal->id);
        $this->repositoryCall->deleteAllByPortalId($dtoPortal->id);

        return $this->repositoryPortal->uninstallByMemberId($memberId);
    }
}
