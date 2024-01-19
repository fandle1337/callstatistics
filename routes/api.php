<?php

use App\Http\Controllers\ControllerAppInstall;
use App\Http\Controllers\ControllerAppSettingList;
use App\Http\Controllers\ControllerAppUnInstall;
use App\Http\Controllers\ControllerStatisticsList;
use App\Http\Middleware\MiddlewareUserAdmin;
use Illuminate\Support\Facades\Route;

Route::post('/app/uninstall', ControllerAppUnInstall::class)->name("app.uninstall");
Route::post('/app/install', ControllerAppInstall::class)->middleware(MiddlewareUserAdmin::class);
Route::get('/app/settings/list', ControllerAppSettingList::class);
Route::post('/app/statistics/list', ControllerStatisticsList::class);
