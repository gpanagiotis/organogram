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
    return view('welcome');
});

//  Organogram
Route::post('organogram/create', 'OrganogramController@create');
Route::post('organogram/update', 'OrganogramController@update');
Route::post('organogram/rename', 'OrganogramController@rename');
Route::post('organogram/delete', 'OrganogramController@delete');
Route::get('organogram/{department?}', 'OrganogramController@index');
Route::resource('organogram', 'OrganogramController');
