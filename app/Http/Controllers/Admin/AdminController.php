<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\BookingDetailRepository;
use App\Repositories\BookingRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $userRepository;
    protected $bookingDetailRepository;
    protected $bookingRepository;

    public function __construct(UserRepository $userRepository, BookingDetailRepository $bookingDetailRepository, BookingRepository $bookingRepository)
    {
        $this->userRepository = $userRepository;
        $this->bookingDetailRepository = $bookingDetailRepository;
        $this->bookingRepository = $bookingRepository;
    }

    /**
     *  Return view Dashboard of admin
     */
    public function dashboard()
    {
        return view('admins.dashboard');
    }

    /**
     * Return view management bookings
     */
    public function booking()
    {
        // GET USER WITH BOOKING
        $booking_details = $this->bookingDetailRepository->with(['room', 'booking'])->get();

        return view('admins.manager-booking', compact('booking_details'));
    }

    /**
     * Update status of booking
     * @param $id(booking_id)
     */
    public function statusBooking($id, Request $request)
    {
        $status = $request->input('status');

        $this->bookingRepository->with([
            'bookingDetails' => function ($query) use ($request) {
                return $query->where(
                    'date_start',
                    $request->input('date_start')
                )->where('date_end', $request->input('date_end'));
            }
        ])->where('id', $id)->update(['status' => $status]);

        return redirect()->back()->with(['success' => 'Update status success']);
    }
}
