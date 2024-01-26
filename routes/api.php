<?php

use App\Http\Controllers\ControllerAppInstall;
use App\Http\Controllers\ControllerAppSettingList;
use App\Http\Controllers\ControllerAppUnInstall;
use App\Http\Controllers\ControllerStatisticsList;
use App\Http\Controllers\ControllerStatisticsDelete;
use App\Http\Controllers\ControllerEventCallEnd;
use App\Http\Middleware\MiddlewareUserAdmin;
use Illuminate\Support\Facades\Route;

Route::post('/app/uninstall', ControllerAppUnInstall::class)->domain(ENV("APP_URL"))->name("app.uninstall");
Route::post('/app/update', ControllerAppUnInstall::class)->domain(ENV("APP_URL"))->name("app.update");
Route::post('/app/install', ControllerAppInstall::class)->middleware(MiddlewareUserAdmin::class);
Route::post('/app/event/bind/{member_id}', ControllerEventCallEnd::class)->domain(ENV("APP_URL"))->name("app.event.rebind");
Route::get('/app/settings/list', ControllerAppSettingList::class);
Route::post('/app/statistics/list', ControllerStatisticsList::class);
Route::get('/app/statistics/delete', ControllerStatisticsDelete::class);
