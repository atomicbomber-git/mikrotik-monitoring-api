<?php

use App\Http\Controllers\ApiNetworkRouterInterfaceController;
use App\Http\Controllers\ApiNetworkRouterInterfaceToggleController;
use App\Http\Controllers\ApiNetworkRouterLogController;
use App\Http\Controllers\ApiNetworkRouterWirelessAccessListController;
use App\Http\Controllers\ApiNetworkRouterWirelessRegistrationTableController;
use App\Http\Controllers\ApiTokenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/auth", [ApiTokenController::class, 'show']);

Route::get("/router/{router}/log/index", [ApiNetworkRouterLogController::class, 'index']);
Route::get("/router/{router}/interface/index", [ApiNetworkRouterInterfaceController::class, 'index']);
Route::post("/router/{router}/interface/toggle/{id}", [ApiNetworkRouterInterfaceToggleController::class, 'update']);
Route::get("/router/{router}/wireless/registration_table/index", [ApiNetworkRouterWirelessRegistrationTableController::class, 'index']);

Route::get("/router/{router}/wireless/access_list/index", [ApiNetworkRouterWirelessAccessListController::class, 'index']);
Route::post("/router/{router}/wireless/access_list/create", [ApiNetworkRouterWirelessAccessListController::class, 'create']);
Route::post("/router/{router}/wireless/access_list/delete", [ApiNetworkRouterWirelessAccessListController::class, 'delete']);
