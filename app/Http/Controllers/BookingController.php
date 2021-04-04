<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookingRequest;
use App\Repositories\BookingRepository;
use App\Repositories\RoomRepository;


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
   * Return view booking form with room_id
   * If user with auth then display information to form
   * IF user is Admin role will return redirect back
   */
  public function create($room_id)
  {
    return $this->bookingRepository->showFormBooking($room_id);
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
