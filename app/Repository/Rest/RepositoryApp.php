<?php

namespace app\Repository\Rest;

use App\Interface\InterfaceRepositoryRestApp;
use Bitrix24\SDK\Core\Exceptions\BaseException;
use Bitrix24\SDK\Services\Main\Result\ApplicationInfoItemResult;
use Bitrix24\SDK\Services\Main\Service\Main;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

class RepositoryApp implements InterfaceRepositoryRestApp
{
    public function __construct(protected Main $application)
    {
    }


    public function getInfo(): ApplicationInfoItemResult|false
    {
        try {
            if(!$json = $this->application->getApplicationInfo()->getCoreResponse()->getHttpResponse()->getContent()) {
                return false;
            }

            if(!$response = json_decode($json, true)) {
                return false;
            }

            if(empty($response['result'])) {
                return false;
            }

            return new ApplicationInfoItemResult($response['result']);

        } catch (ExceptionInterface|BaseException $e) {
            return false;
        }
    }
}
