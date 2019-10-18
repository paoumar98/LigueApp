<?php

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Equipes
    Route::delete('equipes/destroy', 'EquipeController@massDestroy')->name('equipes.massDestroy');
    Route::post('equipes/media', 'EquipeController@storeMedia')->name('equipes.storeMedia');
    Route::resource('equipes', 'EquipeController');

    // Matches
    Route::delete('matches/destroy', 'MatchController@massDestroy')->name('matches.massDestroy');
    Route::resource('matches', 'MatchController');

    // Actuses
    Route::delete('actuses/destroy', 'ActusController@massDestroy')->name('actuses.massDestroy');
    Route::post('actuses/media', 'ActusController@storeMedia')->name('actuses.storeMedia');
    Route::resource('actuses', 'ActusController');
});
