<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BookingDetailRepository;
use App\Entities\BookingDetail;
use App\Validators\BookingDetailValidator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BookingDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BookingDetailRepositoryEloquent extends BaseRepository implements BookingDetailRepository
{
  /**
   * Specify Model class name
   *
   * @return string
   */
  public function model()
  {
    return BookingDetail::class;
  }



  /**
   * Boot up the repository, pushing criteria
   */
  public function boot()
  {
    $this->pushCriteria(app(RequestCriteria::class));
  }

  /**
   * Return view manager booking status
   *
   * @param  mixed $request
   * @return void
   */
  public function managerBooking(Request $request)
  {
    if ($request->has('search')) {
      $data = $request->input('search');
      // search booking by room name or email of booking
      $booking_details = $this->model->with(['booking', 'room'])->whereHas('booking', function (Builder $query) use ($data) {
        $query->where('email', 'like', "%$data%");
      })->orWhereHas('room', function (Builder $query) use ($data) {
        $query->where('name', 'like', "%$data%");
      })->get();
    }
    // GET USER WITH BOOKING
    $booking_details = $this->model->with(['room', 'booking'])->paginate(5);

    return view('admins.manager-booking', compact('booking_details'));
  }
}
