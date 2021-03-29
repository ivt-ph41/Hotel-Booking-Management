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
  public function booking($room_id, CreateBookingRequest $request);
}
