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
    // If request has input search from form search booking
    if ($request->has('search')) {
      $data = $request->input('search');
      // search booking by email of bookings table
      $bookings = $this->model->where('email', 'like',  "%$data%")
        ->paginate(5);
      // Append to the query string of pagination links
      $bookings->appends([
        'search' => $request->input('search')
      ]);
      // if not have result or empty input search field then
      if (count($bookings) == 0 || empty($request->input('search'))) {
        return redirect()->back()->with(['no result found' => 'No Result Found!']);
      }

      // return $comments with search query
      return view('admins.manager-booking', compact('bookings'));
    }
    // Get bookings order by descending
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
    // update status where booking id = $id
    $result = $this->model->where('id', $id)
      ->update([
        'status' => $request->input('status')
      ]);

    // Get current booking by id = $id
    $data = $this->model->find($id)->toArray(); // convert to array
    // create Subject of mail
    if ($data['status'] == Booking::PENDING_STATUS) {
      $subject = 'Hiroto | Your booking status now is pending!';
    } elseif ($data['status'] == Booking::APPROVE_STATUS) {
      $subject = 'Hiroto | Your booking status now is approve!';
    } else {
      $subject = 'Hiroto | Your booking status now is cancel!';
    }

    // Send mail about update status to user via their email
    Mail::send('status-mail', $data, function ($message) use ($data, $subject) {
      $message->to($data['email'])->subject($subject);
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
    // if  user had login to system, only nomal users can view their booking
    if (Auth::check()) {
      //if user is admin role, return  redirect back
      if (Auth::user()->role_id == \App\Entities\Role::ADMIN_ROLE) {
        return redirect()->back();
      }
      // Get user with profile relation ship
      $user = User::with('profile')->find(Auth::id());
      // find room by room id
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
    // Check room from date_start to date_end
    // If have booking with date_start and date_end but it is cancle booking then another user can booking
    \DB::enableQueryLog();
    $roomNotAvailable = Room::whereHas('bookingDetails.booking', function (Builder $query) use ($date_start, $date_end) {
      $query->whereBetween('date_start', [$date_start, $date_end])
        ->orWhereBetween('date_end', [$date_start, $date_end])
        ->where('status', Booking::CANCEL_STATUS);
    })->find($room_id);
    // Check room with status cancel
    // dd(\DB::getQueryLog());
    // dd($roomNotAvailable);
    if (empty($roomNotAvailable)) {
      // With user login to system
      if (Auth::check()) { // Checking if user had login?
        $user_id = Auth::user()->id;

        $booking_data = $request->except('date_start', 'date_end', '_token');
        $booking_data['user_id'] = $user_id;
        // Create new booking
        $this->createBooking($booking_data, $booking_detail);

        // If success
        return redirect()->route('users.booking');
      } else { // With guest

        // Create new resource to bookings table
        $booking_data = $request->except(['date_start', 'date_end', '_token']);

        // Create new booking
        $this->createBooking($booking_data, $booking_detail);

        // Send mail to guest
        $data = $request->all();
        $room = Room::find($room_id)->toArray();
        $data['room'] = $room;

        Mail::send('mail', $data, function ($message) use ($data) {
          $message->to($data['email'])->subject('Hiroto| You have booking success!');
          $message->from('phuoc04012000@gmail.com', 'Admin');
        });
        //if success
        return redirect()->back()->withInput()->with(['booking_success' => 'We had send booking detail to your email, please check it!']);
      }
    } else {
      return redirect()->back()->withInput()->with(['booking_fail' => 'This room have been booking, please try another room or change another day!']);
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
    // update status to cancel
    $this->model->where('id', $id)->update(['status' => \App\Entities\Booking::CANCEL_STATUS]);

    return redirect()->route('users.booking')->with(['status' => 'Cancel success']);
  }
}
