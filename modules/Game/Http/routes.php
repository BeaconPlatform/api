<?php

Route::group(
    [
        'prefix' => 'game'
    ],
    function () {
        Route::group(
            [
                'prefix'        => 'v1',
                'namespace'     => 'Beacon\Api\Game\Http\Controllers\v1',
                'middleware'    => 'oauth'
            ],
            function () {
                Route::get(
                    'accounts',
                    [
                        'uses'  => 'AccountController@index',
                        'as'    => 'game.v1.account.index.get'
                    ]
                );
            }
        );
    }
);
