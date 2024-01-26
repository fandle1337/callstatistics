<?php

namespace App\Http\Controllers;

use App\Service\ServicePortalUninstall;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Sw24\Bitrix24Auth\Dto\DtoAuth;
use Sw24\Sw24RestSdk\Client;
use Sw24\Sw24RestSdk\Exception\ExceptionNotValidateResponse;
use Sw24\Sw24RestSdk\Exception\ExceptionRequestFailed;

class ControllerAppUpdate extends Controller
{
    public function __construct()
    {
    }


    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        //....
    }
}
