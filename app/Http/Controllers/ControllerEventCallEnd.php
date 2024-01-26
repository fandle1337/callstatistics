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
        Log::debug($request);
        exit();
        $memberId = $request->get('member_id');

        $data = [];

        $dtoPortal = $this->repositoryPortal->getByMemberId($memberId);
        $dtoCall = new DtoCall(

        );

        return $this->response(
            $this->repositoryCall->add($dtoCall)
        );
    }
}
