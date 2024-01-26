<?php

namespace App\Repository\Storage;

use App\Interface\Storage\InterfaceRepositorySetting;
use App\Models\PortalSetting;

class RepositorySetting implements InterfaceRepositorySetting
{
    public function addOrUpdateValueByCodeAndPortalId(int $portalId, string $code, int $value): bool
    {
        return PortalSetting::updateOrCreate(
                [
                    'portal_id' => $portalId,
                    'code'      => $code
                ],
                [
                    'portal_id' => $portalId,
                    'code'      => $code,
                    'value'     => $value,
                ]
            ) !== null;
    }

    public function deleteByPortalId(int $portalId): bool
    {
        return PortalSetting::where('portal_id', $portalId)->delete();
    }

    public function getValueByCodeAndPortalId(int $portalId, string $code): int
    {
        $response = PortalSetting::where('portal_id', $portalId)
            ->where('code', $code)
            ->first();

        if ($response) {
            return (int) $response->value;
        }

        return 0;
    }
}
