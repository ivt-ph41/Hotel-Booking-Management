<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoomRepository;
use App\Repositories\PersonRoomRepository;

class RoomController extends Controller
{
    protected $roomRepository;
    protected $personRoomRepository;
    public function __construct(RoomRepository $roomRepository, PersonRoomRepository $personRoomRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->personRoomRepository = $personRoomRepository;
    }

    public function index()
    {
        // Get list person/room in resource
        $person_room_list = $this->personRoomRepository->all();

        // Get all rooms
        $rooms = $this->roomRepository->with(['bed', 'images', 'type', 'personRoom'])->paginate(3);
        // dd($rooms->toArray());

        return view('rooms.index', compact(['rooms', 'person_room_list']));
    }

    public function show($id)
    {
        // Get room by id
        // \DB::enableQueryLog();
        $room = $this->roomRepository->with(['bed', 'images', 'type', 'comments.user', 'personRoom', 'comments' => function ($query) {
            return $query->orderBy('id', 'desc');
        }])->find($id);
        // dd(\DB::getQueryLog());
        // dd($room->toArray());
        return view('rooms.detail', compact('room'));
    }

    public function search(Request $request)
    {
        // dd($request->all());
        // $date_start = $request->input('date_start');
        // $date_start = strtotime($date_start);
        // $date_start = date('Y-m-d', $date_start);

        // $date_end = $request->input('date_end');
        // $date_end = strtotime($date_end);
        // $date_end = date('Y-m-d', $date_end);
        // $rooms = $this->model->with(['bookingDetails' => function ($query) use ($date_start, $date_end) {
        //     return $query->where('date_start', '<', $date_start)
        //         ->orWhere('date_end', '>', $date_end);
        // }]);
    }
}
