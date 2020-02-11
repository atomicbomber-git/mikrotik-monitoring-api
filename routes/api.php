<?php

use App\Http\Controllers\NetworkInterfaceController;
use App\Http\Controllers\NetworkInterfaceToggleController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\AccessListController;
use App\Http\Controllers\NetworkRouterController;
use App\Http\Controllers\RegistrationTableController;
use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\UserLogController;
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

Route::post("/login", [ApiTokenController::class, 'show']);

Route::resource("/router", class_basename(NetworkRouterController::class));
Route::resource("/user_log", class_basename(UserLogController::class))->only(["index", "create"]);

Route::get("/router/{router}/log/index", [LogController::class, 'index']);
Route::get("/router/{router}/interface/index", [NetworkInterfaceController::class, 'index']);
Route::post("/router/{router}/interface/toggle/{id}", [NetworkInterfaceToggleController::class, 'update']);
Route::get("/router/{router}/wireless/registration_table/index", [RegistrationTableController::class, 'index']);

Route::get("/router/{router}/wireless/access_list/index", [AccessListController::class, 'index']);
Route::post("/router/{router}/wireless/access_list/create", [AccessListController::class, 'create']);
Route::post("/router/{router}/wireless/access_list/delete", [AccessListController::class, 'delete']);
