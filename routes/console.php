<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('test', function () {

    dd(app()->make(\App\Service\ServiceCallUpload::class)->upload(new \App\Dto\DtoPortal(
            1,
            'skyweb24.bitrix24.ru',
            'ru',
            'nfr',
            '7ef7b47de517bfb32b13ce6002e91dac',
            '6c63b365006a2fcc000038f40000256f40380757b7925cc1c5eb0e9efe862cab2940aa',
            '5ce2da65006a2fcc000038f40000256f403807ba8543f353dba1f2eb2c15c49b981041',
        )
    ));
});
