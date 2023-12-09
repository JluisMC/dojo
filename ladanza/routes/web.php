<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::any('login/store', function () {
    abort(404);
})->name('loginStore');

Route::get('login','Auth\LoginController@create')->name('loginCreate');
Route::post('login/store', 'Auth\LoginController@store')->name('loginStore');
Route::get('login/destroy', 'Auth\LoginController@destroy')->name('loginDestroy');

