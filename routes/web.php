<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $rooms = \App\Entities\Room::with(['type', 'images'])->take(4)->get();
    // dd($rooms->toArray());
    return view('home', compact('rooms'));
})->name('/');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

/**
 * List all rooms
 */
Route::get('/rooms', 'RoomController@index')->name('rooms.index');

/**
 * Detail room
 */
Route::get('/rooms/{id}', 'RoomController@show')->name('rooms.show');

/**
 * Guest
 */

//Booking
Route::get('rooms/{room_id}/booking', 'BookingController@create')->name('bookings.create');
Route::post('rooms/{room_id}/booking', 'BookingController@store')->name('bookings.store');

// Filter seach room available
Route::get('/rooms/search', 'RoomController@search')->name('room.search');
