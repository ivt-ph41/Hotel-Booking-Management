<?php
Use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'admins',
        'as' => 'admins.',
        'namespace' => 'Admin',
        'middleware' => 'is.admin'
    ],
    function () {
        // View dashboard
        Route::get('dashboards', 'AdminController@dashboard')->name('dashboards');
        Route::get('dashboards/booking', 'AdminController@booking')->name('dashboards.booking');
    }
);
