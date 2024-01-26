<?php

namespace App\Http\Controllers;

use App\Aggregator\AggregatorStatistics;
use App\Dto\DtoCall;
use App\Interface\Storage\InterfaceRepositoryCall;
use App\Interface\Storage\InterfaceRepositoryPortal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Termwind\Components\Dt;

class ControllerEventCallEnd extends Controller
{
    public function __construct(
        protected InterfaceRepositoryPortal $repositoryPortal,
        protected InterfaceRepositoryCall   $repositoryCall,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $memberId = $request->get('auth')['member_id'];
        $data = $request->get('data');

        Log::debug('asd', [$memberId, $data]);
        $dtoPortal = $this->repositoryPortal->getByMemberId($memberId);
        $dtoCall = new DtoCall(
            portalId: $dtoPortal->id,
            userId: (int)$data['PORTAL_USER_ID'],
            portalNumber: $data['PORTAL_NUMBER'],
            duration: (int)$data['CALL_DURATION'],
            date: $data['CALL_START_DATE'],
            cost: (float)$data['COST'],
            costCurrency: $data['COST_CURRENCY'],
            typeId: (int)$data['CALL_TYPE'],
            codeId: (int)$data['CALL_FAILED_CODE'],
        );

        return $this->response(
            $this->repositoryCall->add($dtoCall)
        );
    }
}
