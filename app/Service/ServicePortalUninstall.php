<?php

namespace App\Service;

use App\Interface\Storage\InterfaceRepositoryCall;
use App\Interface\Storage\InterfaceRepositoryPortal;
use App\Interface\Storage\InterfaceRepositoryPortalSetting;

class ServicePortalUninstall
{
    public function __construct(
        protected InterfaceRepositoryPortal        $repositoryPortal,
        protected InterfaceRepositoryCall          $repositoryCall,
        protected InterfaceRepositoryPortalSetting $repositorySetting,
    )
    {
    }

    public function uninstall(string $memberId): bool
    {
        $dtoPortal = $this->repositoryPortal->getByMemberId($memberId);

        $this->repositorySetting->deleteAll($dtoPortal->id);
        $this->repositoryCall->deleteAllByPortalId($dtoPortal->id);

        return $this->repositoryPortal->uninstallByMemberId($memberId);
    }
}
