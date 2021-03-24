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

// Filter seach room available
Route::get('rooms/filter', 'RoomController@filterRoom')->name('rooms.search');

Route::get('/', function () {
    $rooms = \App\Entities\Room::with(['type', 'images'])->take(4)->get();
    // dd($rooms->toArray());
    return view('home', compact('rooms'));
})->name('/');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

/**
 * List rooms
 */
Route::get('rooms', 'RoomController@index')->name('rooms.index');

/**
 * Detail room
 */
Route::get('rooms/{id}', 'RoomController@show')->name('rooms.show');



//Guest booking and user booking
Route::get('rooms/{room_id}/booking', 'BookingController@create')->name('bookings.create');
Route::post('rooms/{room_id}/booking', 'BookingController@store')->name('bookings.store');


// User send comment
Route::post('rooms/{id}/comment', 'CommentController@store')->name('comments.store');


// User Profile
Route::get('users/profile', 'UserController@profile')->name('users.profile');