<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Beacon\Api\Auth\Http\Controllers'], function () {
    Route::get('/', 'OauthController@index');
});
