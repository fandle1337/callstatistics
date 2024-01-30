<?php

namespace App\Service;

use App\Dto\DtoCall;
use App\Dto\DtoPortal;
use App\Enum\EnumPortalSetting;
use App\Interface\Storage\InterfaceRepositoryCall;
use App\Interface\Storage\InterfaceRepositoryPortalSetting;
use App\Repository\Rest\RepositoryRestCall;
use Bitrix24\SDK\Core\Batch;
use Bitrix24\SDK\Core\Core;
use Illuminate\Support\Facades\Log;
use Sw24\Bitrix24Auth\BuilderBitrix24Client;
use Sw24\Bitrix24Auth\Dto\DtoAuth;

class ServiceCallUpload
{
    public function __construct(
        protected InterfaceRepositoryPortalSetting $repositorySetting,
        protected ?Core                            $core,
        protected RepositoryRestCall               $repositoryRestCall,
        protected BuilderBitrix24Client            $builderBitrix24Client,
        protected InterfaceRepositoryCall          $repositoryCall,
    )
    {
    }

    public function upload(DtoPortal $dtoPortal, $limit = 2500): bool
    {
        $lastCallId = $this->repositorySetting->getValueByCode($dtoPortal->id, EnumPortalSetting::LAST_CALL_ID->value);
        $currentCallId = $this->repositorySetting->getValueByCode($dtoPortal->id, EnumPortalSetting::CURRENT_CALL_ID->value);

        if (!$this->isReadyForUpload($lastCallId, $currentCallId)) {
            return false;
        }

        $dtoAuth = new DtoAuth(
            $dtoPortal->domain,
            $dtoPortal->refreshToken,
            $dtoPortal->accessToken,
            $dtoPortal->memberId,
        );

        $newCore = $this->buildCore($dtoAuth);
        $this->setCore($newCore);

        $newBatch = $this->buildBatch($newCore);
        $this->setBatch($newBatch);

        /** @var DtoCall[] $callList */
        $callList = $this->repositoryRestCall->getCallsByPortalId($currentCallId, $lastCallId, $dtoPortal->id, $limit);

        if (empty($callList)) {
            Log::debug("Проблемы с загрузкой звонков", ['ID' => $dtoPortal->id]);
            return false;
        }

        $lastCall = end($callList);

        $this->repositorySetting->addOrUpdateValueByCode($dtoPortal->id, EnumPortalSetting::CURRENT_CALL_ID->value, $lastCall->callId);

        $callList = $this->filterCallList($callList, $dtoPortal->id);

        foreach ($callList as $call) {
            if (!$this->repositoryCall->add($call)) {
                return false;
            }
        }

        return true;
    }

    protected function buildCore(DtoAuth $dtoAuth): Core
    {
        return $this->builderBitrix24Client->buildCore($dtoAuth);
    }

    protected function setCore(Core $core): Core
    {
        $this->repositoryRestCall->setCore($core);
        return $core;
    }

    protected function buildBatch(Core $core): Batch
    {
        return new Batch(
            $core,
            Log::channel("rest")
        );
    }
    protected function setBatch(Batch $batch): Batch
    {
        $this->repositoryRestCall->setBatch($batch);

        return $batch;
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

    protected function isReadyForUpload(int $lastCallId, int $currentCallId): bool
    {
        if ($lastCallId <= $currentCallId) {
            return false;
        }
        return true;
    }
}
