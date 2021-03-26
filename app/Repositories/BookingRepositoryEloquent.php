<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BookingRepository;
use App\Entities\Booking;
use App\Validators\BookingValidator;
use Illuminate\Http\Request;
use App\Entities\BookingDetail;


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
        //  Booking success if current booking of user not exist in system
        $check_booking = BookingDetail::where('room_id', '=', $room_id)
            ->where('date_start', '=', $date_start)
            ->where('date_end', '=', $date_end)
            ->get();
        //        dd($check_booking->toArray());
        $x = 5;
        if ($x == 5) { // if not booking in system, user can booking this room
            // dd('ok');
            if (Auth::check()) { // if user authentication
                $user_id = Auth::user()->id;

                $data = $request->except('date_start', 'date_end', '_token');
                $data['user_id'] = $user_id;

                // Create new resource to bookings table
                $booking = $this->model->create($data);

                // Create booking detail
                $booking->bookingDetails()->create($booking_detail);

                // if success
                return redirect()->route('users.booking');
            } else { // if guest
                // Create new resource to bookings table
                $booking = $this->model->create($request->except(['date_start', 'date_end', '_token']));

                // Create booking detail
                $booking->bookingDetails()->create($booking_detail);
                //if success
                return redirect()->back()->with(['booking_success' => 'We will send status of booking to you, please check your mail!']);
            }
        } else {
            return redirect()->back()->with(['booking_fail' => 'This room have been booking by other user, please try another room or change another day!']);
        }
    }
}
