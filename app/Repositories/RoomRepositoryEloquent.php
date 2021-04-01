<?php

namespace App\Repositories;

use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\EditRoomRequest;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RoomRepository;
use App\Entities\Room;
use App\Entities\Image;
use Countable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    $person_room_id = $request->input('person_room');

    $date_start = $request->input('date_start');
    $date_start = strtotime($date_start);
    $date_start = date('Y-m-d', $date_start);

    $date_end = $request->input('date_end');
    $date_end = strtotime($date_end);
    $date_end = date('Y-m-d', $date_end);

    // \DB::enableQueryLog();
    $rooms = $this->model->with([
      'type',
      'bed',
      'bookingDetails' => function ($query) use ($date_start, $date_end) {
        return $query->where('date_start', '<', $date_start)
          ->Where('date_end', '>', $date_end);
      }
    ])->where('person_room_id', '=', $person_room_id)->get();

    return $rooms;

    // dd(\DB::getQueryLog());
  }

  /**
   * Create new room
   */
  public function storeRoom(CreateRoomRequest $request)
  {
    DB::beginTransaction();
    try {
      $room = $this->model->create($request->only('name', 'price', 'description', 'size', 'bed_id', 'type_id', 'person_room_id'));
      if ($request->hasFile('images')) {
        foreach ($request->file('images') as $key => $image) {
          $imageName = $image->getClientOriginalname();
          $target_dir = 'images/rooms';
          $image->move($target_dir, $imageName);
          $array[$key]['path'] = $imageName;
          $array[$key]['created_at'] = now();
          $array[$key]['updated_at'] = now();
          $array[$key]['room_id'] = $room->id;
        }
      }
      $room->images()->insert($array);

      DB::commit();
      // all good
      return redirect()->back()->with(['success' => 'Success']);
    } catch (\Exception $e) {
      DB::rollback();
      // something went wrong
      return redirect()->back()->with(['error' => 'Something went wrong, please try again!']);
    }
  }

  /**
   * Return view table manager room
   */
  public function showViewManagerRoom(Request $request)
  {
    // If have search action from user
    if ($request->has('search') && !empty($request->input('search'))) {
      $rooms = $this->model->where('name', 'LIKE', '%' . $request->input('search') . '%')->paginate(5);
      $rooms->appends(['search' => $request->input('search')]);
      return view('admins.manager-rooms', compact('rooms'));
    }
    // Default: get all room paginate
    $rooms = $this->model->orderBy('name')->paginate(5);
    return view('admins.manager-rooms', compact('rooms'));
  }

  /**
   * Update room
   */
  public function updateRoom($id, EditRoomRequest $request)
  {
    // dd($request->file('files'));
    // Update room
    $this->model->where('id', $id)->update($request->except('images', '_token', '_method'));
    // Get current images with room id
    $room = $this->model->with('images')->find($id);
    dd($room);

    if ($request->hasFile('files')) {
      foreach ($request->file('files') as $key =>  $file) {
        $imageName = $file->getClientOriginalname();
        // dd($imageName);
        $target_dir = 'images/rooms';
        $file->move($target_dir, $imageName);
        $array[$key]['path'] = $imageName;
      }
    }
    foreach ($room->images as $key => $image) {
      Image::where('id', $image->id)->where('room_id', $id)->update(['path' => $array[$key]['path']]);
    }
    return 'Success';
  }

  /**
   * Destroy room
   */
  public function destroyRoom($id)
  {
    DB::beginTransaction();
    try {
      \App\Entities\Image::where('room_id', $id)->delete();
      $this->model->where('id', $id)->delete();
      DB::commit();
      // all good
      return redirect()->back()->withInput()->with(['status' => 'Delete Success!']);
    } catch (\Exception $e) {
      DB::rollback();
      // something went wrong
      return redirect()->back()->withInput()->with(['status' => 'Something went wrong, please try again!']);
    }
  }
}
