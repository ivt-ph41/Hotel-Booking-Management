<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookingRepository;
use App\Repositories\RoomRepository;

class BookingController extends Controller
{
    protected $bookingRepository;
    protected $roomRepository;
    public function __construct(BookingRepository $bookingRepository, RoomRepository $roomRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->roomRepository = $roomRepository;
    }

    public function create($room_id)
    {
        // if  current user loggin in system
        if (\Auth::check()) {
            $user = \Auth::user();
            $profile = $user->profile()->get();
            // dd($profile->toArray());
            $room = $this->roomRepository->find($room_id);
            return view('bookings.create', compact('room', 'profile'));
        }
        //Get current room for booking
        $room = $this->roomRepository->find($room_id);
        return view('bookings.create', compact('room'));
    }

    public function store($room_id, Request $request)
    {
        $this->bookingRepository->booking($room_id, $request);
        return 'SUCCESS';
    }
}
