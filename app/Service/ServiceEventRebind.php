<?php

namespace App\Service;

use Bitrix24\SDK\Core\Core;

class ServiceEventRebind
{
    public function __construct(
        protected Core $core
    )
    {
    }

    public function rebind(string $event, string $handler): bool
    {
        $this->unbind($event, $handler);
        return $this->bind($event, $handler);
    }

    protected function bind(string $event, string $handler): bool
    {
        try {
            $this->core->call("event.bind", [
                'EVENT'   => $event,
                'HANDLER' => $handler,
            ]);

            return true;

        } catch (TransportException|BaseException $e) {
            return false;
        }
    }

    protected function unbind(string $event, string $handler): bool
    {
        try {
            $this->core->call("event.unbind", [
                'EVENT'   => $event,
                'HANDLER' => $handler,
            ]);

            return true;

        } catch (TransportException|BaseException $e) {
            return false;
        }
    }

}
