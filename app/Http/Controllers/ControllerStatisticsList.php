<?php

namespace App\Http\Controllers;

use App\Aggregator\AggregatorStatistics;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ControllerStatisticsList extends Controller
{
    public function __construct(
        protected AggregatorStatistics $aggregatorStatistics,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $year = $request->get('year');
        $quarter = $request->get('quarter');

        return $this->response($this->aggregatorStatistics->make($quarter, $year));
    }
}
