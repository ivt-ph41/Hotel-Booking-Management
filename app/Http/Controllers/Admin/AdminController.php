<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\EditRoomRequest;
use App\Repositories\BedRepository;
use App\Repositories\BookingDetailRepository;
use App\Repositories\BookingRepository;
use App\Repositories\ImageRepository;
use App\Repositories\PersonRoomRepository;
use App\Repositories\RoomRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserRepository;
use App\RepositoriesImageRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $userRepository;
    protected $bookingDetailRepository;
    protected $bookingRepository;
    protected $roomRepository;
    protected $bedRepo;
    protected $typeRepo;
    protected $personRoomRepo;
    protected $imageRepo;

    public function __construct(
        UserRepository $userRepository,
        BookingDetailRepository $bookingDetailRepository,
        BookingRepository $bookingRepository,
        RoomRepository $roomRepository,
        BedRepository $bedRepo,
        TypeRepository $typeRepo,
        PersonRoomRepository $personRoomRepo,
        ImageRepository $imageRepo
    )
    {
        $this->userRepository = $userRepository;
        $this->bookingDetailRepository = $bookingDetailRepository;
        $this->bookingRepository = $bookingRepository;
        $this->roomRepository = $roomRepository;
        $this->bedRepo = $bedRepo;
        $this->typeRepo = $typeRepo;
        $this->personRoomRepo = $personRoomRepo;
        $this->imageRepo = $imageRepo;
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
     * @param $id (booking_id)
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

    /**
     *Show form create new room
     */
    public function showFormCreateRoom()
    {
        //      Get all bed and type of room
        $beds = $this->bedRepo->orderBy('name')->all();
        $types = $this->typeRepo->orderBy('name')->all();
        $person_rooms = $this->personRoomRepo->orderBy('name')->all();
        return view('admins.create-room', compact('beds', 'types', 'person_rooms'));
    }

    /**
     * Create new room in resources
     */
    public function storeRoom(CreateRoomRequest $request)
    {
        return $this->roomRepository->storeRoom($request);
    }

    /**
     * Return view table manager rooms
     */
    public function managerRoom(Request $request)
    {
        return $this->roomRepository->showViewManagerRoom($request);
    }

    /**
     * Show form edit room
     */
    public function editRoom($id)
    {
        //Find room
        $room =  $this->roomRepository->find($id);
        // Get all bed and type of room
        $beds = $this->bedRepo->orderBy('name')->all();
        $types = $this->typeRepo->orderBy('name')->all();
        $person_rooms = $this->personRoomRepo->orderBy('name')->all();
        return view('admins.edit-room', compact('room','beds', 'types', 'person_rooms'));
    }
    /**
     * Update room from form edit room
     */
    public  function updateRoom($id, EditRoomRequest $request)
    {
    return $this->roomRepository->updateRoom($id, $request);
    }

    /**
     * Delete room in resources
     */
    public function deleteRoom($id)
    {
        return $this->roomRepository->destroyRoom($id);
    }
}