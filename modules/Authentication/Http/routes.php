<?php

Route::group(
    [
        'prefix' => 'authentication'
    ],
    function () {
        Route::group(
            [
                'prefix' => 'oauth2',
                'namespace' => '\Beacon\Api\Authentication\Http\Controllers\OAuth2'
            ],
            function () {
                Route::post(
                    'token',
                    [
                        'as' => 'authentication.oauth2.token.post',
                        'uses' => 'TokenController@issue'
                    ]
                );
            }
        );
    }
);
