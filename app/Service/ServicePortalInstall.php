<?php

namespace App\Service;

use App\Dto\DtoPortal;
use App\Enum\EnumPortalSetting;
use App\Interface\Rest\InterfaceRepositoryRestCall;
use App\Interface\Storage\InterfaceRepositoryPortal;
use App\Interface\Storage\InterfaceRepositoryPortalSetting;

class ServicePortalInstall
{
    public function __construct(
        protected InterfaceRepositoryPortal        $repositoryPortal,
        protected InterfaceRepositoryRestCall      $repositoryRestCall,
        protected InterfaceRepositoryPortalSetting $repositorySetting,
        protected ServiceCallUpload                $serviceCallUpload,
    )
    {
    }

    public function install(DtoPortal $dtoPortal): bool
    {
        if (!$portalId = $this->repositoryPortal->addOrUpdate($dtoPortal)->id) {
            return false;
        }

        $lastCallId = $this->repositoryRestCall->getLastId();
        $dtoPortal->id = $portalId;

        $this->repositorySetting->addOrUpdateValueByCode($portalId, EnumPortalSetting::LAST_CALL_ID->value, $lastCallId);

        return $this->serviceCallUpload->upload($dtoPortal, 1000);
    }
}
