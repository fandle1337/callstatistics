<?php

namespace App\Service;

use App\Interface\Storage\InterfaceRepositoryCall;
use App\Interface\Storage\InterfaceRepositoryPortal;
use Sw24\Bitrix24Auth\Dto\DtoAuth;

class ServiceCallDelete
{
    public function __construct(
        protected InterfaceRepositoryCall   $repositoryCall,
        protected InterfaceRepositoryPortal $repositoryPortal,
        protected DtoAuth                   $dtoAuth,
    )
    {
    }

    public function delete(): bool
    {
        $dtoPortal = $this->repositoryPortal->getByMemberId($this->dtoAuth->memberId);
        return $this->repositoryCall->deleteAllByPortalId($dtoPortal->id);
    }
}
