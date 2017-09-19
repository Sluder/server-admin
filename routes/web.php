<?php

Route::get('/', 'PageController@server')->name('home');
Route::get('/server', 'PageController@server')->name('server');
Route::get('/website/{website}', 'PageController@website')->name('website');
