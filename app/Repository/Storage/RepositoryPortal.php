<?php

namespace App\Repository\Storage;

use App\Dto\DtoPortal;
use App\Interface\Storage\InterfaceRepositoryPortal;
use App\Models\Portal;

class RepositoryPortal implements InterfaceRepositoryPortal
{
    public function addOrUpdate(DtoPortal $dtoPortal)
    {
        return Portal::updateOrCreate(
            ['member_id' => $dtoPortal->memberId],
            [
                'domain'         => $dtoPortal->domain,
                'license'        => $dtoPortal->license,
                'language'       => $dtoPortal->lang,
                'member_id'      => $dtoPortal->memberId,
                'access_token'   => $dtoPortal->accessToken,
                'refresh_token'  => $dtoPortal->refreshToken,
                'date_uninstall' => null,
            ]
        );
    }

    public function uninstallByMemberId(string $memberId): bool
    {
        return Portal::where('member_id', $memberId)
            ->update(['date_uninstall' => date("Y-m-d H:i:s")]);
    }

    public function getByMemberId(string $memberId): DtoPortal|bool
    {
        $result = Portal::where('member_id', $memberId)->first();

        if (!$result) {
            return false;
        }

        return new DtoPortal(
            $result->id,
            $result->domain,
            $result->lang,
            $result->license,
            $result->member_id,
            $result->access_token,
            $result->refresh_token,
        );
    }

    public function getActiveClients(): array
    {
        $response = Portal::whereNull('date_uninstall')->get();

        foreach ($response as $row) {
            $result[] = new DtoPortal(
                id: $row->id,
                domain: $row->domain,
                lang: $row->language,
                license: $row->license,
                memberId: $row->member_id,
                accessToken: $row->access_token,
                refreshToken: $row->refresh_token,
            );
        }
        return $result ?? [];
    }

}
