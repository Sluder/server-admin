<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'PageController@server')->name('home');
    Route::get('/website/{website}', 'PageController@website')->name('website');

    Route::get('/server', 'PageController@server')->name('server');
    Route::get('/server/usage', 'ServerController@getUsage');
    Route::post('/server/reboot', 'ServerController@reboot')->name('server.reboot');
});