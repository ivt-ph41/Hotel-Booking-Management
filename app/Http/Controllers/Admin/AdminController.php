<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\EditRoomRequest;
use App\Repositories\BedRepository;
use App\Repositories\BookingDetailRepository;
use App\Repositories\BookingRepository;
use App\Repositories\PersonRoomRepository;
use App\Repositories\RoomRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\CommentRepository;
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
  protected $profileRepo;
  protected $commentRepo;

  public function __construct(
    UserRepository $userRepository,
    BookingDetailRepository $bookingDetailRepository,
    BookingRepository $bookingRepository,
    RoomRepository $roomRepository,
    BedRepository $bedRepo,
    TypeRepository $typeRepo,
    PersonRoomRepository $personRoomRepo,
    ProfileRepository $profileRepo,
    CommentRepository $commenRepo
  ) {
    $this->userRepository = $userRepository;
    $this->bookingDetailRepository = $bookingDetailRepository;
    $this->bookingRepository = $bookingRepository;
    $this->roomRepository = $roomRepository;
    $this->bedRepo = $bedRepo;
    $this->typeRepo = $typeRepo;
    $this->personRoomRepo = $personRoomRepo;
    $this->profileRepo = $profileRepo;
    $this->commentRepo = $commenRepo;
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
    $booking_details = $this->bookingDetailRepository->with(['room', 'booking.user.profile',])->paginate(5);

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
    return view('admins.edit-room', compact('room', 'beds', 'types', 'person_rooms'));
  }
  /**
   * Update room from form edit room
   */
  public  function updateRoom($id, EditRoomRequest $request)
  {
    return $this->roomRepository->updateRoom($id, $request);
  }

  /**
   * Show form edit user
   * @param int $id
   * @return $user
   */
  public function editUser($id)
  {
    $user = $this->userRepository->with('profile')->find($id);
    return view('admins.users.edit-user', compact('user'));
  }

  /**
   * Update profile user from form edit user
   *
   */
  public function updateUser($id, EditProfileRequest $request)
  {
    if ($this->profileRepo->where('user_id', $id)->update($request->except('_token', '_method'))) {
      return redirect()->back()->with(['success' => 'Update success!']);
    }
    return redirect()->back()->with(['error' => 'Update fail, something error!']);
  }
  /**
   * Delete room in resources
   * @param int $id
   */
  public function deleteRoom($id)
  {
    return $this->roomRepository->destroyRoom($id);
  }

  /**
   * Return view table manager users
   */
  public function managerUser(Request $request)
  {
    return $this->userRepository->showViewManagerUser($request);
  }

  /**
   * Delete user
   */
  public function deleteUser($id)
  {
    return $this->userRepository->deleteUser($id);
  }

  /**
   * Show view manager comments
   *
   * @param  mixed $request
   * @return void
   */
  public function managerComment(Request $request)
  {
    return $this->commentRepo->showTableManager($request);
  }
  // /**
  //  * Get all comments in resource
  //  *
  //  * @return void
  //  */
  // public function commentIndex()
  // {
  //   $comments = $this->commentRepo->with(['user', 'room'])->get();
  //   return response()->json($comments, 200);
  // }

  /**
   * destroy comment in resource
   *
   * @param  mixed $id
   * @return void
   */
  public function deleteComment($id)
  {
    $this->commentRepo->destroy($id);
    return redirect()->back()->with(['status' => 'Delete comment success']);
  }
}
