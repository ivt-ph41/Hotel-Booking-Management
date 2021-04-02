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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('/');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Filter seach room available
Route::get('rooms/filter', 'RoomController@filterRoom')->name('rooms.filter');

// Search room using ajax
Route::get('rooms/search', 'RoomController@searchRoom')->name('rooms.search');

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

// Show current booking of user
Route::get('users/bookings', 'UserController@userBooking')->name('users.booking');

// User send comment
Route::post('rooms/{id}/comment', 'CommentController@store')->name('comments.store');


// User Profile
Route::get('users/profile', 'UserController@profile')->name('users.profile');

// Edit User Profile
Route::get('users/edit/profile', 'UserController@edit')->name('users.edit');

Route::put('users/change/profile', 'UserController@update')->name('users.update');

// Edit User password
Route::get('users/change/password', 'UserController@changePassword')->name('users.change-password');

Route::put('users/change/password', 'UserController@updatePassword')->name('users.update-password');
