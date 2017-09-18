<?php

Route::get('/', 'PageController@home')->name('home');
Route::get('/server', 'PageController@server')->name('server');
