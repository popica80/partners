<?php
Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1'], function () {
    Route::prefix('auth')->group(function () {
        Route::get('user', 'AuthController@user');
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
    });
});
