<?php

namespace App\Http\Controllers;

use App\Aggregator\AggregatorStatistics;
use App\Dto\DtoCall;
use App\Interface\Storage\InterfaceRepositoryCall;
use App\Interface\Storage\InterfaceRepositoryPortal;
use App\Service\ServiceCallAdd;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Termwind\Components\Dt;

class ControllerEventCallEnd extends Controller
{
    public function __construct(
        protected ServiceCallAdd $serviceCallAdd,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $memberId = $request->get('auth')['member_id'];
        $callData = $request->get('data');

        return $this->response(
            $this->serviceCallAdd->add($memberId, $callData)
        );
    }
}
