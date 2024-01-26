<?php

namespace App\Http\Controllers;

use App\Aggregator\AggregatorStatistics;
use App\Interface\Storage\InterfaceRepositoryCall;
use App\Interface\Storage\InterfaceRepositoryPortal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContorllerEventCallEnd extends Controller
{
    public function __construct(
        protected InterfaceRepositoryPortal $repositoryPortal,
        protected InterfaceRepositoryCall   $repositoryCall,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $memberId = $request->get('member_id');

        $data = [];

        $dtoPortal = $this->repositoryPortal->getByMemberId($memberId);

        return $this->repositoryCall->addCallByPoratalId($dtoPortal->id, $data);

        dd($request->getPayload());
    }
}
