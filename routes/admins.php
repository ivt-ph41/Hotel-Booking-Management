<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [

        'middleware' => 'is.admin'
    ],
    function () {
        // return  View dashboard
        Route::get('dashboards', 'AdminController@dashboard')->name('dashboards');

        /**
         * Manager booking status
         */
        // return  View manager all booking
        Route::get('dashboards/booking', 'AdminController@booking')->name('dashboards.booking');
        // Update status of booking from view manager booking
        Route::put('dashboards/booking/{id}', 'AdminController@statusBooking')->name('update.status-booking');

        /**
         * Create room
         */
        // return view form create room
        Route::get('dashboards/forms/room', 'AdminController@showFormCreateRoom')->name('room.create');
        // create room from form create room
        Route::post('dashboards/forms/room', 'AdminController@storeRoom')->name('room.store');

        /**
         * Manager rooms
         */
        // Return view table manager rooms
        Route::get('manager/rooms', 'AdminController@managerRoom')->name('room.manager');
        // Edit room
        Route::get('/manager/rooms/{id}/edit', 'AdminController@editRoom')->name('room.edit');
        Route::put('manager/rooms/{id}', 'AdminController@updateRoom')->name('room.update');
        // Delete room
        Route::delete('manager/rooms/{id}', 'AdminController@deleteRoom')->name('room.destroy');

        /**
         * Manager users
         */
      Route::get('manager/users', 'AdminController@managerUser')->name('user.manager');
      // Edit user profile
      Route::get('/manager/users/{id}/edit', 'AdminController@editUser')->name('user.edit');
      Route::put('manager/users/{id}', 'AdminController@updateUser')->name('user.update');
      // Delete room
      Route::delete('manager/users/{id}', 'AdminController@deleteUser')->name('user.destroy');

    }
);
