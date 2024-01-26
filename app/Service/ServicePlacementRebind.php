<?php

namespace App\Service;

use Bitrix24\SDK\Core\Core;
use Bitrix24\SDK\Core\Exceptions\BaseException;
use Bitrix24\SDK\Core\Exceptions\TransportException;

class ServicePlacementRebind
{
    public function __construct(
        protected Core $core
    )
    {
    }

    public function rebind(string $placement, string $handler): bool
    {
        $this->unbind($placement, $handler);
        return $this->bind($placement, $handler);
    }

    protected function bind(string $placement, string $handler): bool
    {
        try {
            $this->core->call("placement.bind", [
                'PLACEMENT'   => $placement,
                'HANDLER' => $handler,
            ]);

            return true;

        } catch (TransportException|BaseException $e) {
            return false;
        }
    }

    protected function unbind(string $placement, string $handler): bool
    {
        try {
            $this->core->call("placement.unbind", [
                'PLACEMENT'   => $placement,
                'HANDLER' => $handler,
            ]);

            return true;

        } catch (TransportException|BaseException $e) {
            return false;
        }
    }

}
