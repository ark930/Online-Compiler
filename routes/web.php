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

Auth::routes();

Route::get('/', 'RunController@index');

Route::post('/run', 'RunController@run');

Route::post('terminals', 'TerminalController@create');

Route::group([
    'prefix' => 'codes',
    'middleware' => ['auth']
], function () {
    Route::get('/', 'CodeController@index');
    Route::post('/', 'CodeController@create');
});