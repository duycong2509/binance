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

Route::get('/', function () {
    return redirect()->route('price.index');
});
Route::get('prices', ['as' => 'price.index', 'uses' => 'VolumeController@index']);

Route::get('prices/all', ['as' => 'price.all', 'uses' => 'VolumeController@priceAll']);

Route::get('get/symbol', 'VolumeController@getVolumeSymbol');

Route::get('chi-tiet/{symbol}', ['as' => 'volume.symbol', 'uses' => 'VolumeController@getAllVolumeSymbol']);