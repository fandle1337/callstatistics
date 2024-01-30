<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('test', function () {

    dd(app()->make(\App\Aggregator\AggregatorStatistics::class)->make(0, 2023));

});
