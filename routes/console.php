<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('test', function () {

    dd(app()->make(\App\Http\Controllers\ControllerEventCallEnd::class));

});
