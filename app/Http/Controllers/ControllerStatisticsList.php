<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerStatisticsList extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->response([
            1,1,1
        ]);
    }
}
