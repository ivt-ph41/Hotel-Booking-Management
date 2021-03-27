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
        // return  View dashboard
        Route::get('dashboards', 'AdminController@dashboard')->name('dashboards');
        // return  View manager all booking
        Route::get('dashboards/booking', 'AdminController@booking')->name('dashboards.booking');
        // Update status of booking from view manager booking
        Route::put('dashboards/booking/{id}', 'AdminController@statusBooking')->name('update.status-booking');
        // return view form create room
        Route::get('dashboards/forms/room', 'AdminController@showFormCreateRoom')->name('room.create');
        // create room from form create room
        Route::post('dashboards/forms/room', 'AdminController@storeRoom')->name('room.store');
    }
);
