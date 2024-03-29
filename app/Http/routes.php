<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/

//Route::resource('/items', 'IndexController');
Route::get('/', function () {
    return view('pages.index');
});

Route::group(['middleware' => ['web']], function () {
    Route::resource('items', 'ItemController');
    Route::resource('j-items', 'ItemController@jindex');
    Route::get('items/{id}', 'ItemController@edit');
    Route::post('items', 'ItemController@store');
    Route::put('items/{id}', 'ItemController@update');
    Route::delete('items/{id}', 'ItemController@destroy');
});
