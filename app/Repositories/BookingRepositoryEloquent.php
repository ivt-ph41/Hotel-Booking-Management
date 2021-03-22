<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BookingRepository;
use App\Entities\Booking;
use App\Validators\BookingValidator;
use Illuminate\Http\Request;

/**
 * Class BookingRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BookingRepositoryEloquent extends BaseRepository implements BookingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Booking::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function booking($room_id, Request $request)
    {
        $date_start = $request->input('date_start');
        $date_start = strtotime($date_start);
        $date_start = date('Y-m-d', $date_start);

        $date_end = $request->input('date_end');
        $date_end = strtotime($date_end);
        $date_end = date('Y-m-d', $date_end);

        $booking_detail = [
            'room_id' => $room_id,
            'date_start' => $date_start,
            'date_end' => $date_end
        ];
        if (\Auth::check()) {
            $user_id = \Auth::user()->id;

            $data = $request->except('date_start', 'date_end', '_token');
            $data['user_id'] = $user_id;

            $booking = $this->model->create($data);
            // Create booking detail
            $booking->bookingDetails()->create($booking_detail);
        } else {
            $booking = $this->model->create($request->except(['date_start', 'date_end', '_token']));
            // Create booking detail
            $booking->bookingDetails()->create($booking_detail);
        }
    }
}
