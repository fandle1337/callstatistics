<?php

namespace App\Service;

use App\Dto\DtoCall;
use App\Dto\DtoPortal;
use App\Interface\Storage\InterfaceRepositoryCall;
use App\Interface\Storage\InterfaceRepositorySetting;
use App\Repository\Rest\RepositoryRestCall;
use Bitrix24\SDK\Core\Batch;
use Bitrix24\SDK\Core\Core;
use Illuminate\Support\Facades\Log;
use Sw24\Bitrix24Auth\BuilderBitrix24Client;
use Sw24\Bitrix24Auth\Dto\DtoAuth;

class ServiceCallUpload
{
    public function __construct(
        protected InterfaceRepositorySetting $repositorySetting,
        protected ?Core                      $core,
        protected RepositoryRestCall         $repositoryRestCall,
        protected BuilderBitrix24Client      $builderBitrix24Client,
        protected InterfaceRepositoryCall    $repositoryCall,
    )
    {
    }

    public function upload(DtoPortal $dtoPortal): bool
    {
        $lastCallId = $this->repositorySetting->getValueByCodeAndPortalId($dtoPortal->id, 'last_call_id');
        $currentCallId = $this->repositorySetting->getValueByCodeAndPortalId($dtoPortal->id, 'current_call_id');

        $dtoAuth = new DtoAuth(
            $dtoPortal->domain,
            $dtoPortal->refreshToken,
            $dtoPortal->accessToken,
            $dtoPortal->memberId,
        );

        $newCore = $this->mapNewCore($dtoAuth);
        $newBatch = $this->mapNewBatch($newCore);

        $callList = $this->repositoryRestCall->getCallsByPortalId($currentCallId, $lastCallId, $dtoPortal->id);

        if (empty($callList)) {
            return false;
        }

        $lastCall = end($callList);

        $this->repositorySetting->addOrUpdateValueByCodeAndPortalId($dtoPortal->id, 'current_call_id', $lastCall->callId);

        $callList = $this->filterCallList($callList, $dtoPortal->id);

        foreach ($callList as $call) {
            if (!$this->repositoryCall->add($call)) {
                return false;
            }
        }

        return true;
    }

    protected function mapNewCore(DtoAuth $dtoAuth): Core
    {
        $newCore = $this->builderBitrix24Client->buildCore($dtoAuth);
        $this->repositoryRestCall->setCore($newCore);

        return $newCore;
    }

    protected function mapNewBatch(Core $core): Batch
    {
        $newBatch = new Batch(
            $core,
            Log::channel("rest")
        );

        $this->repositoryRestCall->setBatch($newBatch);

        return $newBatch;
    }

    /**
     * @param DtoCall[] $callList
     */
    protected function filterCallList(array $callList, $portalId): array
    {
        foreach ($callList as $call) {
            $callIdList[] = $call->callId;
        }

        $existingIdList = $this->repositoryCall->isHasByPortalId($callIdList ?? [], $portalId);

        foreach ($callList as $key => $call) {
            if (in_array($call->callId, $existingIdList)) {
                unset($callList[$key]);
            }
        }

        return $callList;
    }
}
