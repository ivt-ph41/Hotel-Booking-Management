<?php

namespace App\Repositories;

use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\EditRoomRequest;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RoomRepository;
use App\Entities\Room;
use App\Entities\Image;
use App\Entities\Booking;
use App\Entities\BookingDetail;
use App\Entities\PersonRoom;
use Countable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

/**
 * Class RoomRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoomRepositoryEloquent extends BaseRepository implements RoomRepository
{
  /**
   * Specify Model class name
   *
   * @return string
   */
  public function model()
  {
    return Room::class;
  }


  /**
   * Boot up the repository, pushing criteria
   */
  public function boot()
  {
    $this->pushCriteria(app(RequestCriteria::class));
  }

  /*
  * Filter room by date and a number person/room
  */
  public function filterRoom(Request $request)
  {
    //Make validator
    $validator = Validator::make($request->all(), [
      'date_start' => 'required|before:date_end',
      'date_end' => 'required',
      'person_room' => 'required'
    ]);
    // If validate fail then return redirect back with error
    if ($validator->fails()) {
      return redirect()->route('rooms.index')->with(['error' => 'Error date_start must be before date_end!']);
    }
    // Get list person_room_id to display for select option
    $person_room_id = $request->input('person_room');

    // convert date to format 'Y-m-d'
    $date_start = $request->input('date_start');
    $date_start = strtotime($date_start);
    $date_start = date('Y-m-d', $date_start);

    $date_end = $request->input('date_end');
    $date_end = strtotime($date_end);
    $date_end = date('Y-m-d', $date_end);

    // Room have booking in booking detail
    $roomNotAvailable = $this->model->whereHas('bookingDetails', function (Builder $query) use ($date_start, $date_end) {
      $query->whereBetween('date_start', [$date_start, $date_end])
        ->orWhereBetween('date_end', [$date_start, $date_end]);
    })->pluck('id'); // get all id of room not available

    // Room not have booking in booking detail
    $roomAvailable = $this->model->with(['type', 'bed', 'bookingDetails'])
      ->whereNotIn('id', $roomNotAvailable)
      ->where('person_room_id', '=', $person_room_id)->paginate(3);

    // Append to the query string of pagination links
    $roomAvailable->appends([
      'date_start' => $date_start,
      'date_end' => $date_end,
      'person_room' => $person_room_id
    ]);
    // Get list person/room in resource for 'filter room'
    $person_room_list = PersonRoom::all();
    return view('rooms.index', compact('roomAvailable', 'person_room_list'));
  }

  /**
   * search room
   */
  public function searchRoom(Request $request)
  {
    // if request has search
    if ($request->has('search')) {
      // $query == value input search
      $query = $request->input('search');
      // Search room with room name
      $rooms = $this->model->where('name', 'LIKE', "%$query%")->select('rooms.id', 'rooms.name')->get();

      // return response with json with http status 200
      return response()->json($rooms, 200);
    }
  }
  /**
   * store new room in resources
   *
   * @param  mixed $request
   * @return void
   */
  public function storeRoom(CreateRoomRequest $request)
  {
    // start transaction
    DB::beginTransaction();
    try {
      // create new room in rooms table
      $room = $this->model->create($request->only('name', 'price', 'description', 'size', 'bed_id', 'type_id', 'person_room_id'));

      // If request has file upload
      if ($request->hasFile('images')) {
        foreach ($request->file('images') as $key => $image) {
          // Get file name inclue extention
          $imageName = $image->getClientOriginalname();
          // Declare target dir contain image in public/images/rooms forder
          $target_dir = 'images/rooms';
          // Move images to target dir
          $image->move($target_dir, $imageName);
          // Add information to array for store new resource in images table
          $array[$key]['path'] = $imageName;
          $array[$key]['created_at'] = now();
          $array[$key]['updated_at'] = now();
          $array[$key]['room_id'] = $room->id;
        }
      }
      // Insert new resource in images table with data = $array by using relationship
      $room->images()->insert($array);

      // All OK then commit
      DB::commit();
    } catch (\Exception $e) {
      // something went wrong
      DB::rollback();
      // return redirect back with session error
      return redirect()->back()->with(['error' => 'Something went wrong, please try again!']);
    }
    // return route manager room with session 'create success'
    return redirect()->route('admins.room.manager')->with(['create success' => 'Success']);
  }

  /**
   * Return view table manager room
   */
  public function showViewManagerRoom(Request $request)
  {
    // If have search action from user
    if ($request->has('search')) {
      $rooms = $this->model->where('name', 'LIKE', '%' . $request->input('search') . '%')->paginate(5);

      // Append to the query string of pagination links
      $rooms->appends(['search' => $request->input('search')]);

     // if not have result
     if (count($rooms) == 0) {
      $noResultFound = '';
      // dd($bookings->toArray());
      return view('admins.manager-rooms', compact('rooms', 'noResultFound'));
    }
    // get total of result
    $totalResult = $rooms->total();

    // return $bookings with search query and display total result
    return view('admins.manager-rooms', compact('rooms', 'totalResult'));
    }
    // Default: get all room
    $rooms = $this->model->orderBy('id', 'desc')->paginate(5);

    return view('admins.manager-rooms', compact('rooms'));
  }

  /**
   * Update room
   */
  public function updateRoom($id, EditRoomRequest $request)
  {
    // Update room where room id = $id
    $this->model->where('id', $id)->update($request->except('images', '_token', '_method'));
    // if success then return view manager room with session success
    return redirect()->route('admins.room.manager')->with(['update success' => 'Update success']);
  }

  /**
   * destroy Room if room not have booking with status approve and pending
   *
   * @param  mixed $id (room id)
   * @return void
   */
  public function destroyRoom($id)
  {
    /* Retrieve current booking
    has status approve or pending with room id */
    $booking_details = BookingDetail::whereHas('booking', function (Builder $query) {
      $query->whereIn('status', [Booking::APPROVE_STATUS, Booking::PENDING_STATUS]);
    })->where('room_id', $id)->get();

    /* If $booking_detail == [] (not have booking with approve or pending)
    then can delete this room */
    if (count($booking_details) == 0) {
      DB::beginTransaction();

      try {
        foreach ($booking_details as $booking_detail) {
          // Delete booking detail
          BookingDetail::destroy($booking_detail->id);
          // Delete booking
          Booking::destroy($booking_detail->booking_id);
        }
        // Delete images of room
        Image::where('room_id', $id)->delete();
        // Delete room
        $this->model->where('id', $id)->delete();

        // all good
        DB::commit();
      } catch (\Exception $e) {
        DB::rollback();
        // something went wrong
        return redirect()->back()->with(['something wrong' => 'Something went wrong, please try again!']);
      }
      return redirect()->route('admins.room.manager')->with(['delete success' => 'Delete Success!']);
    }
    // default
    return redirect()->back()->with(['delete fail' => 'Delete fail!']);
  }
}
