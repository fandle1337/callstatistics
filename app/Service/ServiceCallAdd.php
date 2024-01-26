<?php

namespace App\Service;

use App\Dto\DtoCall;
use App\Dto\DtoPortal;
use App\Interface\Storage\InterfaceRepositoryCall;
use App\Interface\Storage\InterfaceRepositoryPortal;

class ServiceCallAdd
{
    public function __construct(
        protected InterfaceRepositoryPortal $repositoryPortal,
        protected InterfaceRepositoryCall   $repositoryCall,
    )
    {
    }

    public function add(string $memberId, array $callData): bool
    {
        $dtoPortal = $this->repositoryPortal->getByMemberId($memberId);

        $dtoCall = new DtoCall(
            portalId: $dtoPortal->id,
            userId: (int)$callData['PORTAL_USER_ID'],
            portalNumber: $callData['PORTAL_NUMBER'],
            duration: (int)$callData['CALL_DURATION'],
            date: $callData['CALL_START_DATE'],
            cost: (float)$callData['COST'],
            costCurrency: $callData['COST_CURRENCY'],
            typeId: (int)$callData['CALL_TYPE'],
            codeId: (int)$callData['CALL_FAILED_CODE'],
        );

        return $this->repositoryCall->add($dtoCall);
    }
}
