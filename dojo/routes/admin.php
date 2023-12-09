<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function(){

    Route::get('/', 'Admin\DashboardController@index')->name('dashboard_index');

    //Person
    route::get('change/{id}', 'Admin\PersonController@change_subscription')->name('person_change_subscription');
    route::get('change/user/{id}', 'Admin\PersonController@change_user_subscription')->name('person_user_change_subscription');


    Route::get('register', 'Admin\PersonController@createPersonClient')->name('person_client_create');
    Route::post('register', 'Admin\PersonController@storePersonClient')->name('person_client_store');
    Route::put('person/client/update/{id}', 'Admin\PersonController@updatePersonClient')->name('person_client_update');

    Route::get('register/person/user', 'Admin\PersonController@createPersonUser')->name('person_user_create');;
    Route::post('register/person/user/store', 'Admin\PersonController@storePersonUser')->name('person_user_store');
    Route::put('person/user/update/{id}', 'Admin\PersonController@updatePersonUser')->name('person_user_update');


    //User
    Route::get('users', 'Admin\UserController@index')->name('user_index');
    Route::get('user/create/{id}', 'Admin\UserController@create')->name('user_create');
    Route::post('user/store', 'Admin\UserController@store')->name('user_store');
    Route::get('user/show/{id}', 'Admin\UserController@show')->name('user_show');
    Route::get('user/edit/{id}', 'Admin\UserController@edit')->name('user_edit');
    Route::put('user/update/{id}', 'Admin\UserController@update')->name('user_update');
    Route::put('reset/password/{id}', 'Admin\UserController@resetPassword')->name('user_reset_password');
    Route::get('permissions/{id}', 'Admin\UserController@permissions')->name('user_permissions');
    Route::put('permissions/save/{id}', 'Admin\UserController@permissionsSave')->name('user_permissions_save');
    Route::get('user/{id}/destroy', 'Admin\UserController@destroy')->name('user_destroy');
    Route::get('user/{id}/restore', 'Admin\UserController@restore')->name('user_destroy');

    //Client
    Route::get('customers', 'Admin\ClientController@index')->name('client_index');
    Route::get('client/export', 'Admin\ClientController@export')->name('client_export');
    Route::get('client/create/{id}', 'Admin\ClientController@create')->name('client_create');
    Route::post('client/register', 'Admin\ClientController@store')->name('client_store');
    Route::get('client/detail/{id}', 'Admin\ClientController@show')->name('client_show');
    Route::get('client/edit/{id}', 'Admin\ClientController@edit')->name('client_edit');
    Route::put('client/update/{id}', 'Admin\ClientController@update')->name('client_update');
    Route::get('client/{id}/destroy', 'Admin\ClientController@destroy')->name('client_destroy');
    Route::get('client/{id}/restore', 'Admin\ClientController@restore')->name('client_destroy');

    //Roles
    Route::get('role/index', 'Admin\RoleController@index')->name('role_index');
    Route::get('role/create', 'Admin\RoleController@create')->name('role_create');
    Route::post('role/store', 'Admin\RoleController@store')->name('role_store');
    Route::get('role/edit/{id}', 'Admin\RoleController@edit')->name('role_edit');
    Route::put('role/update/{id}', 'Admin\RoleController@update')->name('role_update');
    Route::get('role/{id}/destroy', 'Admin\RoleController@destroy')->name('role_destroy');
    Route::get('role/{id}/restore', 'Admin\RoleController@restore')->name('role_destroy');
});
