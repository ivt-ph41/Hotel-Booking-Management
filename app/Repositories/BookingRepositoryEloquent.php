<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BookingRepository;
use App\Entities\Booking;
use App\Entities\BookingDetail;
use App\Http\Requests\CreateBookingRequest;
use App\User;
use App\Entities\Room;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Mail;

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


  /**
   * updata Status of booking
   *
   * @param  mixed $booking_id
   * @param  mixed $request
   * @return void
   */
  public function updateStatus($booking_id, Request $request)
  {
    $booking_detai_id = $request->input('bookingDetailId');

    $result = $this->model->with(['bookingDetails' => function ($query) use ($booking_detai_id) {
      return $query->where('id', $booking_detai_id); // where id is booking detail id
    }])->where('id', $booking_id)->update(['status' => $request->input('status')]); // where booking id = $id

    if ($result) { // success
      return redirect()->back()->with(['success' => 'Update status success']);
    }
    // fail
    return redirect()->back()->with(['update fail' => 'Update status fail']);
  }
  /**
   * User
   * showFormBooking for user
   *
   * @return void
   */
  public function showFormBooking($room_id)
  {
    // if  current user loggin in system
    if (Auth::check()) {
      //if user is admin, redirect back
      if (Auth::user()->role_id == \App\Entities\Role::ADMIN_ROLE) {
        return redirect()->back();
      }

      $user = User::with('profile')->find(Auth::id());
      $room = Room::find($room_id);
      return view('bookings.create', compact('room', 'user'));
    }
    //Get current room for booking
    $room = Room::find($room_id);
    return view('bookings.create', compact('room'));
  }

  /**
   * User or guest
   * Store booking of user or guest
   *
   * @param  mixed $room_id
   * @param  mixed $request
   * @return void
   */
  public function booking($room_id, CreateBookingRequest $request)
  {
    // convert to date format
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
    //checking current booking of user vs in system
    $check_booking = BookingDetail::where('room_id', '=', $room_id)
      ->where('date_start', '=', $date_start)
      ->where('date_end', '=', $date_end)
      ->get();

    if (count($check_booking) == 0) { // if not have this booking in system, user can booking this room

      if (Auth::check()) { // if user authentication
        $user_id = Auth::user()->id;

        $data = $request->except('date_start', 'date_end', '_token');
        $data['user_id'] = $user_id;
        // dd($data);
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


        // Send mail to guest
        $data = $request->all();
        $room = Room::find($room_id);
        $data['room'] = $room;
        // dd($data);
        Mail::send('mail', $data, function ($message) use($data) {
          $message->to($data['email'])->subject('Hiroto hotel booking');
          $message->from('phuoc04012000@gmail.com', 'Hiroto hotel');
        });
        //if success
        return redirect()->back()->with(['booking_success' => 'We had send booking detail to your email, please check it!']);
      }
    } else {
      return redirect()->back()->with(['booking_fail' => 'This room have been booking, please try another room or change another day!']);
    }
  }


  /**
   * User cancel booking
   *
   * @param  mixed $id booking id
   * @return void
   */
  public function cancelBooking($id)
  {
    // Delete booking detail first
    BookingDetail::where('booking_id', $id)->delete();

    // Detele booking
    $this->model->where('id', $id)->delete();

    return redirect()->route('users.booking')->with(['status' => 'Cancel success']);
  }
}
