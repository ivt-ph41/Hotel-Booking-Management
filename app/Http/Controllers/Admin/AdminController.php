<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\BookingDetailRepository;

class AdminController extends Controller
{
    protected $userRepository;
    protected $bookingDetailRepository;
    public function __construct(UserRepository $userRepository,BookingDetailRepository $bookingDetailRepository)
    {
        $this->userRepository = $userRepository;
        $this->bookingDetailRepository = $bookingDetailRepository;
    }

    /**
     *  Return view Dashboard of admin
     */
    public function dashboard ()
    {
        return view('admins.dashboard');
    }

    /**
     * Return view management bookings
     */
    public function booking()
    {
        // GET USER WITH BOOKING
        $booking_details = $this->bookingDetailRepository->with(['room', 'booking.user'])->get();

        return view('admins.manager-booking', compact('booking_details'));
    }
}
