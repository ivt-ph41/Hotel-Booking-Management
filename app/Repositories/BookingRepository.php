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
   * showFormBooking for user
   *
   * @return void
   */
  public function showFormBooking($room_id);

  /**
   * booking
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
