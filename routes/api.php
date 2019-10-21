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

Route::middleware(['auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::name('api.')->group(function (){
        Route::get('/banners', 'BannerApiController@banners')->name('banners');
        Route::get('/checkupdate', 'BannerApiController@checkUpdate')->name('banners.update');

        //Local de Risco
            Route::get('/local-risco/index', 'LocalRiscoController@index')->name('localrisco.index');
            Route::post('/local-risco/store', 'LocalRiscoController@store')->name('localrisco.store');


        Route::apiResources([
            'user' => 'UserController',
        ]);
    });
});


