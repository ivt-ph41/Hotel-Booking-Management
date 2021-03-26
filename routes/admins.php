<?php

use Illuminate\Support\Facades\Route;

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
        // View manager all booking
        Route::get('dashboards/booking', 'AdminController@booking')->name('dashboards.booking');
        // Update status of booking
        Route::put('dashboards/booking/{id}', 'AdminController@statusBooking')->name('update.status-booking');
    }
);
