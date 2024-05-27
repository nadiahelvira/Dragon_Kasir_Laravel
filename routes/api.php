<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list_po', 'App\Http\Controllers\Api\AccApiController@List_PO');
Route::get('/list_po_id', 'App\Http\Controllers\Api\AccApiController@List_PO_ID');
Route::post('/pp_bengkel', 'App\Http\Controllers\Api\AccApiController@pp_bengkel');
Route::post('/beli_bengkel', 'App\Http\Controllers\Api\AccApiController@beli_bengkel');
Route::post('/keluar_bengkel', 'App\Http\Controllers\Api\AccApiController@keluar_bengkel');

