<?php

namespace App\Dto;

class DtoPortal
{
    public function __construct(
        public ?int    $id = null,
        public ?string $domain = null,
        public ?string $lang = null,
        public ?string $license = null,
        public ?string $memberId = null,
        public ?string $accessToken = null,
        public ?string $refreshToken = null,
        public ?string $dateUninstall = null,
    )
    {
    }
}
