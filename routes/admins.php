<?php
Use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'admins',
        'as' => 'admins.',
        'middleware' => 'is.admin'
    ],
    function () {
        // View dashboard
        Route::get('dashboards', 'AdminController@dashboard')->name('dashboards');
    }
);
