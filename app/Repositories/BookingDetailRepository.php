<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;
use Illuminate\Http\Request;
/**
 * Interface BookingDetailRepository.
 *
 * @package namespace App\Repositories;
 */
interface BookingDetailRepository extends RepositoryInterface
{
  /**
   * Return view manager booking status
   *
   * @param  mixed $request
   * @return void
   */
  public function managerBooking(Request $request);
}
