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

use PEAR2\Net\RouterOS\Client as RouterOSClient;
use Symfony\Component\HttpFoundation\Request;

Route::post("/test", function (Request $request) {
    // return "SHIT";
    // $request->validate([
    //     "username" => "required|string|max:256",
    //     "password" => "required|string|max:256",
    // ]);

    return $request->ajax() ? "TRUE" : "FALSE";

    // try {
    //     $client = new RouterOSClient("192.168.88.1", "admin", "");
    //     return "OK";
    // }
    // catch (\Exception $e) {
    //     return "FAIL";
    // }
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
