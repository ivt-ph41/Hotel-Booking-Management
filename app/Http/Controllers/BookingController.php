<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookingRequest;
use App\Repositories\BookingRepository;
use App\Repositories\RoomRepository;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
  protected $bookingRepository;
  protected $roomRepository;
  public function __construct(BookingRepository $bookingRepository, RoomRepository $roomRepository)
  {
    $this->bookingRepository = $bookingRepository;
    $this->roomRepository = $roomRepository;
  }

  /**
   * return view booking form with room_id
   */
  public function create($room_id)
  {
    // if  current user loggin in system
    if (Auth::check()) {
      //if user is admin, redirect back
      if (Auth::user()->role_id == \App\Entities\Role::ADMIN_ROLE) {
        return redirect()->back();
      }
      // TODO: need optimize this user 'with'profile
      $user = Auth::user();
      $profile = $user->profile()->get(); //! Need Optimaze this code
      // dd($profile->toArray());
      $room = $this->roomRepository->find($room_id);
      return view('bookings.create', compact('room', 'profile'));
    }
    //Get current room for booking
    $room = $this->roomRepository->find($room_id);
    return view('bookings.create', compact('room'));
  }

  /**
   * Store new booking in bookings table and booking_details table
   */
  public function store($room_id, CreateBookingRequest $request)
  {
    return $this->bookingRepository->booking($room_id, $request);
  }


  /**
   * cancelBooking
   *
   * @param  mixed $id
   * @return void
   */
  public function cancelBooking($id)
  {
    return $this->bookingRepository->cancelBooking($id);
  }
}
