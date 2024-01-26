<?php

namespace App\Service;

use App\Dto\DtoPortal;
use App\Interface\Rest\InterfaceRepositoryRestCall;
use App\Interface\Storage\InterfaceRepositoryPortal;
use App\Interface\Storage\InterfaceRepositorySetting;

class ServicePortalInstall
{
    public function __construct(
        protected InterfaceRepositoryPortal   $repositoryPortal,
        protected InterfaceRepositoryRestCall $repositoryRestCall,
        protected InterfaceRepositorySetting  $repositorySetting,
        protected ServiceCallUpload           $serviceCallUpload,
    )
    {
    }

    public function install(DtoPortal $dtoPortal): bool
    {
        if ($portalId = $this->repositoryPortal->addOrUpdate($dtoPortal)->id) {
            $lastCallId = $this->repositoryRestCall->getLastId();
            $dtoPortal->id = $portalId;

            $this->repositorySetting->addOrUpdateValueByCodeAndPortalId($portalId, 'last_call_id', $lastCallId);

            return $this->serviceCallUpload->upload($dtoPortal, 1000);
        }
        return false;
    }
}
