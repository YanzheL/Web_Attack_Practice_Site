<?php

use App\Http\Controllers\ApiCrypto;
use Illuminate\Http\Request;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::match(['post','get'],'/crypto/{apiname}/{apiargv}', function (Request $request,$apiname, $apiargv) {
// $api_controller = new ApiCtl();
// return $api_controller->processor($request, $apicategory, $apiname, $apiargv);
// });

// Route::match([
//     'post',
//     'get'
// ], '/crypto/{apiname}/{apiargv}', function (Request $request, $apiname, $apiargv) {
//     $api_controller = new ApiCrypto();
//     return $api_controller->processor($request, $apiname, $apiargv);
// });

Route::resource('messages', 'MessageCtl');

