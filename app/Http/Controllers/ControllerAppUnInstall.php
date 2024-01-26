<?php

namespace App\Http\Controllers;

use App\Service\ServicePortalUninstall;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Sw24\Bitrix24Auth\Dto\DtoAuth;
use Sw24\Sw24RestSdk\Client;
use Sw24\Sw24RestSdk\Exception\ExceptionNotValidateResponse;
use Sw24\Sw24RestSdk\Exception\ExceptionRequestFailed;

class ControllerAppUnInstall extends Controller
{
    public function __construct(
        protected Client               $sw24ApiClient,
        protected DtoAuth              $dtoAuth,
        protected ServicePortalUninstall $servicePortalUninstall,
    )
    {
    }

    /**
     * @throws GuzzleException
     * @throws ExceptionNotValidateResponse
     * @throws ExceptionRequestFailed
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->servicePortalUninstall->uninstall($this->dtoAuth->memberId);

        return $this->response(
            $this->sw24ApiClient
                ->callUnInstallApplication($this->dtoAuth->domain, env("MODULE_CODE"))
                ->isSuccess()
        );
    }
}
