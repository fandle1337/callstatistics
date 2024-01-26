<?php

namespace App\Http\Controllers;

use App\Service\ServiceCallDelete;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ControllerStatisticsDelete extends Controller
{
    public function __construct(
        protected ServiceCallDelete $serviceCallDelete,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        return $this->response(
            $this->serviceCallDelete->delete()
        );
    }
}
