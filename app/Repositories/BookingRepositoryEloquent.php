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
use Illuminate\Support\Facades\DB;

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
   * Return view manager booking status
   *
   * @param  mixed $request
   * @return void
   */
  public function managerBooking(Request $request)
  {
    if ($request->has('search')) {
      $data = $request->input('search');
      // search booking by  email of bookings table
      $bookings = $this->model->where('email', 'like',  "%$data%")
      ->paginate(5);
      // Append to the query string of pagination links
      $bookings->appends([
        'search' => $request->input('search')
      ]);
      return view('admins.manager-booking', compact('bookings'));
    }
    // Get bookings order by descending (last booking first)
    $bookings = $this->model->orderBy('id', 'desc')->paginate(5);

    return view('admins.manager-booking', compact('bookings'));
  }

  /**
   * updata Status of booking
   *
   * @param  mixed $booking_id
   * @param  mixed $request
   * @return void
   */
  public function updateStatus($id, Request $request)
  {
    $result = $this->model->where('id', $id)
                          ->update([
                            'status' => $request->input('status')
                          ]);

    // Get current booking by id = $id
    $data = $this->model->find($id)->toArray();

    Mail::send('status-mail', $data, function ($message) use ($data) {
      $message->to($data['email'])->subject('Hiroto hotel');
      $message->from('phuoc04012000@gmail.com', 'Admin');
    });
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

  public function createBooking($booking, $booking_detail)
  {
    DB::beginTransaction();
    try {
      // Create new resource to bookings table
      $booking = $this->model->create($booking);

      // Create booking details with booking relation ship
      $booking->bookingDetails()->create($booking_detail);

      // all good
      DB::commit();
    } catch (\Exception $e) {
      // Some thing went wrong

      DB::rollBack();
      return redirect()->back()->with(['error' => 'Some thing wrong!']);
    }
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

    /* Checking booking detail with room id,
    get room in booking detail table with $room_id
    */
    $roomNotAvailable = Room::whereHas('bookingDetails', function (Builder $query) use ($date_start, $date_end) {
      $query->whereBetween('date_start', [$date_start, $date_end])
        ->orWhereBetween('date_end', [$date_start, $date_end]);
    })->find($room_id);


    /* If room not have in booking detail
    from date_start to date_end
    then user can booking
    */
    if (empty($roomNotAvailable)) {

      // With user login to system
      if (Auth::check()) { // Checking if user had login?
        $user_id = Auth::user()->id;

        $booking_data = $request->except('date_start', 'date_end', '_token');
        $booking_data[] = $user_id;

        // Create new booking
        $this->createBooking($booking_data, $booking_detail);

        // If success
        return redirect()->route('users.booking');
      } else { // With guest

        // Create new resource to bookings table
        $booking_data =$request->except(['date_start', 'date_end', '_token']);

        // Create new booking
        $this->createBooking($booking_data, $booking_detail);

        // Send mail to guest
        $data = $request->all();
        $room = Room::find($room_id)->toArray();
        $data['room'] = $room;

        Mail::send('mail', $data, function ($message) use ($data) {
          $message->to($data['email'])->subject('Hiroto hotel');
          $message->from('phuoc04012000@gmail.com', 'Admin');
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
