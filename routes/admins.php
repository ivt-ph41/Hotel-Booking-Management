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
    // Delete room
    Route::delete('manager/rooms/delete/{id}', 'AdminController@deleteRoom')->name('room.destroy');
  }
);
