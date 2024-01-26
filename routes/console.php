<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('test', function () {

    dd(app()->make(\App\Service\ServiceCallUpload::class)->upload(new \App\Dto\DtoPortal(
            1,
            'skyweb24.bitrix24.ru',
            'ru',
            'nfr',
            '7ef7b47de517bfb32b13ce6002e91dac',
            'cb45b265006a2fcc000038f40000256f4038070c7945255fbc5d0daaa76c722bcbb680',
            'bbc4d965006a2fcc000038f40000256f40380789c392257af7df2222e7a41da7c3b236',
        )
    ));
});
