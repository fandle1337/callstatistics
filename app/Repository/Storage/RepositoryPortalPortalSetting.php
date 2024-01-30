<?php

namespace App\Repository\Storage;

use App\Interface\Storage\InterfaceRepositoryPortalSetting;
use App\Models\PortalSetting;

class RepositoryPortalPortalSetting implements InterfaceRepositoryPortalSetting
{
    public function addOrUpdateValueByCode(int $portalId, string $code, mixed $value): bool
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

    public function deleteAll(int $portalId): bool
    {
        return PortalSetting::where('portal_id', $portalId)->delete();
    }

    public function getValueByCode(int $portalId, string $code): int
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
