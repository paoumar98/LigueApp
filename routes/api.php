<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Equipes
    Route::post('equipes/media', 'EquipeApiController@storeMedia')->name('equipes.storeMedia');
    Route::apiResource('equipes', 'EquipeApiController');

    // Matches
    Route::apiResource('matches', 'MatchApiController');

    // Actuses
    Route::post('actuses/media', 'ActusApiController@storeMedia')->name('actuses.storeMedia');
    Route::apiResource('actuses', 'ActusApiController');
});
