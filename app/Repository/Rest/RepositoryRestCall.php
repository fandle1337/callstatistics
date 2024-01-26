<?php

namespace App\Repository\Rest;

use App\Dto\DtoCall;
use App\Interface\Rest\InterfaceRepositoryRestCall;
use Bitrix24\SDK\Core\Batch;
use Bitrix24\SDK\Core\Core;
use Bitrix24\SDK\Core\Exceptions\BaseException;
use Bitrix24\SDK\Core\Exceptions\TransportException;
use Bitrix24\SDK\Services\Main\Service\Main;

class RepositoryRestCall extends RepositoryRestAbstract implements InterfaceRepositoryRestCall
{
    public function __construct(
        protected ?Core  $core,
        protected ?Main  $main,
        protected ?Batch $batch
    )
    {
    }

    public function getTotal(): int
    {
        try {
            $response = $this->core->call(
                'voximplant.statistic.get',
            );

            return $response->getResponseData()->getPagination()->getTotal();

        } catch (BaseException|TransportException $e) {
            return 0;
        }
    }

    public function getLastId(): int
    {
        try {
            $response = $this->core->call(
                'voximplant.statistic.get',
                [
                    'ORDER' => 'DESC',
                    'SORT'  => 'ID',
                ]
            );

            return $response->getResponseData()->getResult()[0]['ID'];

        } catch (BaseException|TransportException $e) {
            return 0;
        }
    }

    public function getCallsByPortalId(int $currentCallId, int $lastCallId, int $portalId): array
    {
        try {
            $response = $this->batch->getTraversableListWithCount(
                'voximplant.statistic.get',
                ['ID' => 'ASC'],
                [
                    '<=ID' => $lastCallId,
                    '>ID'  => $currentCallId,
                ],
                [],
                2500
            );

            foreach ($response as $call) {
                $result[] = new DtoCall(
                    portalId: $portalId,
                    userId: $call['PORTAL_USER_ID'] ?? null,
                    callId: $call['ID'] ?? null,
                    portalNumber: $call['PORTAL_NUMBER'] ?? null,
                    duration: $call['CALL_DURATION'] ?? null,
                    date: $call['CALL_START_DATE'] ?? null,
                    cost: $call['COST'] ?? 0.00,
                    costCurrency: $call['COST_CURRENCY'],
                    typeId: (int)$call['CALL_TYPE'],
                    codeId: (int)$call['CALL_FAILED_CODE'],
                );
            }
            return $result ?? [];
        } catch (BaseException|TransportException $e) {
            dd($e);
            return [];
        }
    }

}
