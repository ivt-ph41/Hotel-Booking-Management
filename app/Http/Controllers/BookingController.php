<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookingRepository;
use App\Repositories\RoomRepository;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected $bookingRepository;
    protected $roomRepository;
    public function __construct(BookingRepository $bookingRepository, RoomRepository $roomRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->roomRepository = $roomRepository;
        $this->middleware('auth')->only('show');
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

    /**
     * Store new booking in bookings table and booking_details table
     */
    public function store($room_id, Request $request)
    {
        $this->bookingRepository->booking($room_id, $request);
        if (Auth::check()) {
            return redirect()->route('users.booking');
        }

        return redirect()->back()->withInput()->with(['booking_success' => 'We will send status of booking to you, please check your mail!']);
    }
}
