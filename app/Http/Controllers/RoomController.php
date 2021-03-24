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
        $rooms = $this->roomRepository->with(['bed', 'images', 'type', 'personRoom'])->Paginate(5);

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

    public function filterRoom(Request $request)
    {
        // Get list person/room in resource
        $person_room_list = $this->personRoomRepository->all();

        // Get rooms by filter
        $rooms = $this->roomRepository->filterRoom($request);

        return view('rooms.index', compact('rooms', 'person_room_list'));
    }
}
