<?php

namespace App\Http\Controllers;


use App\Dto\DtoPortal;
use App\Repository\Rest\RepositoryRestRestApp;
use App\Service\ServiceEventRebind;
use App\Service\ServicePortalInstall;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Sw24\Bitrix24Auth\Dto\DtoAuth;
use Sw24\Sw24RestSdk\Client;
use Sw24\Sw24RestSdk\Exception\ExceptionNotValidateResponse;
use Sw24\Sw24RestSdk\Exception\ExceptionRequestFailed;


class ControllerAppInstall extends Controller
{
    public function __construct(
        protected Client                $sw24ApiClient,
        protected DtoAuth               $dtoAuth,
        protected ServicePortalInstall  $servicePortalInstall,
        protected RepositoryRestRestApp $repositoryApp,
        protected ServiceEventRebind    $serviceEvent,
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
        $this->sw24ApiClient->callInstallApplication(
            $this->dtoAuth->domain,
            env("MODULE_CODE"),
            $this->dtoAuth->memberId,
            $this->dtoAuth->accessToken,
            $this->dtoAuth->refreshToken
        );

        if (!$this->serviceEvent->rebind('OnAppUpdate', route("app.update"))) {
            return $this->response("Не удалось назначить обработчик события обновления", 400, "error");
        }

        if (!$this->serviceEvent->rebind('OnAppUninstall', route("app.update"))) {
            return $this->response("Не удалось назначить обработчик события удаления приложения", 400, "error");
        }

        if (!$this->serviceEvent->rebind('OnVoximplantCallEnd', route("app.event.rebind", ['member_id' => $this->dtoAuth->memberId]))) {
            return $this->response("Не удалось назначить обработчик события окончания разговора", 400, "error");
        }

        $portalInfo = $this->repositoryApp->getInfo();

        $dtoPortal = new DtoPortal(
            domain: $this->dtoAuth->domain,
            lang: $portalInfo->LANGUAGE_ID,
            license: $portalInfo->LICENSE_TYPE,
            memberId: $this->dtoAuth->memberId,
            accessToken: $this->dtoAuth->accessToken,
            refreshToken: $this->dtoAuth->refreshToken,
        );

        return $this->response(
            $this->servicePortalInstall->install($dtoPortal)
        );
    }
}
