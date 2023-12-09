<?php

use Illuminate\Support\Facades\Route;

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


//Connection
Route::get('login', 'Auth\LoginController@create')->name('login');
Route::post('login/store', 'Auth\LoginController@store')->name('login_store');
Route::get('login/destroy/{id}', 'Auth\LoginController@destroy')->name('login_destroy');

//Information
Route::get('la/casa/del/peleador', 'Front\InfoController@index')->name('info_index');
Route::post('la/casa/del/peleador', 'Front\InfoController@searchClient')->name('info_search');


