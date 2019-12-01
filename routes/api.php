<?php

use App\Http\Controllers\ApiNetworkRouterInterfaceController;
use App\Http\Controllers\ApiNetworkRouterLogController;
use App\Http\Controllers\ApiTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Route::get("/router_log/{router}/index", [ApiNetworkRouterLogController::class, 'index']);
Route::get("/router_interface/{router}/index", [ApiNetworkRouterInterfaceController::class, 'index']);

