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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'DeveloperController@index')->name('developers');
Route::get('/developers/{id}', 'DeveloperController@devInfo')->name('dev');
Route::post('addTech', 'DeveloperController@addTech');
Route::post('removeTech', 'DeveloperController@removeTech');
Route::post('removeProject', 'DeveloperController@removeProject');