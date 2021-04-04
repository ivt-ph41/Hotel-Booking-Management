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
  // Creating booking of user
  public function booking($room_id, CreateBookingRequest $request);

  //User cancel booking
  public function cancelBooking($id);
}
