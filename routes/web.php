<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\NetworkRouterStatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::fallback(function () {
    return redirect()->route("user.index");
});

Route::get("/network-router/status", [NetworkRouterStatusController::class, "index"])->name("network-router-status.index");
Route::resource("user", class_basename(UserController::class));