<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('test', function () {

    app()->make(\App\Repository\RepositoryRestApp::class)->getInfo();

    dd("test");
});
