<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoomRepository;
use App\Repositories\PersonRoomRepository;
use App\Repositories\CommentRepository;
use PhpParser\Node\Expr\FuncCall;

class RoomController extends Controller
{
  protected $roomRepository;
  protected $personRoomRepository;
  protected $commentRepo;
  public function __construct(RoomRepository $roomRepository, PersonRoomRepository $personRoomRepository, CommentRepository $commentRepo)
  {
    $this->roomRepository = $roomRepository;
    $this->personRoomRepository = $personRoomRepository;
    $this->commentRepo = $commentRepo;
  }

  public function index()
  {
    // Get list person/room in resource for filter function
    $person_room_list = $this->personRoomRepository->all();

    // Get all rooms
    $rooms = $this->roomRepository->with(['bed', 'images', 'type', 'personRoom'])->Paginate(5);

    return view('rooms.index', compact(['rooms', 'person_room_list']));
  }

  public function show($id)
  {
    // Get room by id with comment
    $room = $this->roomRepository->with(['bed', 'images', 'type', 'personRoom'])->find($id);

    $comments = $this->commentRepo->with('user')->where('room_id' , $id)->orderBy('id', 'desc')->paginate(3);

    return view('rooms.detail', compact('room', 'comments'));
  }

  /**
   * Filter room
   */
  public function filterRoom(Request $request)
  {
    return $this->roomRepository->filterRoom($request);
  }

  /**
   * Search room by name
   */
  public function searchRoom(Request $request)
  {
    return $this->roomRepository->searchRoom($request);
  }
}
