<?php

Route::prefix('/admin')->group(function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //Rutas persona
    Route::get('person/user/create','PersonController@createPersonUser')->name('personUserCreate'); 
    Route::post('person/user/store','PersonController@storePersonUser')->name('personUserStore');
    Route::get('person/client/create','PersonController@createPersonClient')->name('personClientCreate');
    Route::post('person/client/store','PersonController@storePersonClient')->name('personClientStore');

    //Rutas usuario
    Route::get('user/index', 'UserController@index')->name('userIndex');
    Route::get('user/create/{id}', 'UserController@create')->name('userCreate');
    Route::post('user/store', 'UserController@store')->name('userStore');
    Route::get('user/edit{id}', 'UserController@edit')->name('userEdit');

    //Rutas cliente
    Route::resource('client', 'ClientController');

    //Rutas direccion
    Route::get('address/create/{id}', 'AddressController@create')->name('addressCreate');
    Route::post('address/store', 'AddressController@store')->name('addressStore');

    //Rutas roles
    Route::get('roles/index', 'RoleController@index')->name('rolesIndex');
    Route::get('rol/create', 'RoleController@create')->name('rolCreate');
    Route::post('rol/store', 'RoleController@store')->name('rolStore');
    Route::get('rol/edit/{id}', 'RoleController@edit')->name('rolEdit');
    Route::put('rol/update/{id}', 'RoleController@update')->name('rolUpdate');
    Route::get('permissions/edit/{id}', 'RoleController@editPermissions')->name('permissionsEdit');
    Route::put('permissions/update/{id}', 'RoleController@updatePermissions')->name('permissionsUpdate');

    Route::any('/{any}', function () {
        abort(404);
    })->where('any', '.*');

});