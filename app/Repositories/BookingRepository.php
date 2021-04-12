<?php

namespace App\Repositories;

use App\Http\Requests\CreateBookingRequest;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BookingRepository.
 *
 * @package namespace App\Repositories;
 */
interface BookingRepository extends RepositoryInterface
{
  /**
   * Return view manager booking status in admin darshboard
   *
   * @param  mixed $request
   * @return void
   */
  public function managerBooking(Request $request);

  /**
   * showFormBooking for user
   *
   * @return void
   */
  public function showFormBooking($room_id);

  /**
   * create booking and booking_detail
   *
   * @param  array $booking This is booking array data
   * @param  array $booking_detail This is booking detail data
   * @return void
   */
  public function createBooking($booking, $booking_detail);
  /**
   * Store new booking
   *
   * @param  mixed $room_id
   * @param  mixed $request
   * @return void
   */
  public function booking($room_id, CreateBookingRequest $request);

  /**
   * Admin
   * update Status of booking
   *
   * @param  mixed $booking_id
   * @param  mixed $request
   * @return void
   */
  public function updateStatus($booking_id, Request $request);

  /**
   * User
   * cancel Booking
   *
   * @param  mixed $id
   * @return void
   */
  public function cancelBooking($id);
}
