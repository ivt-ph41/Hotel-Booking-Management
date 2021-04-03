<?php

namespace App\Repositories;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Entities\Role;
use App\Entities\Booking;
use App\Entities\BookingDetail;
use App\Entities\Comment;
use App\Entities\Profile;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
  /**
   * Specify Model class name
   *
   * @return string
   */
  public function model()
  {
    return User::class;
  }



  /**
   * Boot up the repository, pushing criteria
   */
  public function boot()
  {
    $this->pushCriteria(app(RequestCriteria::class));
  }

  /**
   * Register user
   */
  public function register(RegisterUserRequest $request)
  {
    $data = $request->only('email', 'password');
    $data['password'] = Hash::make($data['password']);

    // Get User's role = 2
    $data['role_id'] = \App\Entities\Role::USER_ROLE;


    DB::beginTransaction();
    try {
      // Begin a transaction

      // Do something and save to the db...

      // Store new resource to users table
      $user = $this->model->create($data);
      // Store new resource to profiles table with $user
      $user->profile()->create($request->only('name', 'phone', 'address'));

      // Commit the transaction
      DB::commit();
    } catch (\Exception $e) {
      // An error occured; cancel the transaction...
      DB::rollback();
      // and throw the error again.
      throw new \Exception($e->getMessage());
    }

    return $user;
  }

  public function updatePassword(ChangePasswordRequest $request)
  {
    if (Hash::check($request->input('current_password'), Auth::user()->password)) {
      // Update new password
      $this->model->where('id', Auth::id())->update([
        'password' => Hash::make($request->input('new_password'))
      ]);
      return redirect()->back()->with(['success' => 'Your current password is update']);
    }
    return redirect()->back()->with(['error' => 'Your current password is not correct!']);
  }

  public function showViewManagerUser(Request $request)
  {
    // If have search action from user
    if ($request->has('search') && !empty($request->input('search'))) {
      // dd('aa');
      $users = $this->model->with(['profile'])->where('role_id', Role::USER_ROLE)->where('email', 'LIKE', '%' . $request->input('search') . '%')->orderBy('email')->paginate(3);
      $users->appends(['search' => $request->input('search')]);
      return view('admins.users.manager-users', compact('users'));
    }
    // Default: get all user paginate
    // $users = $this->model->with(['profile'])->select('users.*', 'profiles.*')->orderBy('profiles.name')->paginate(5);
    $users = $this->model->with(['profile'])->where('role_id', Role::USER_ROLE)->orderBy('email')->paginate(3);
    // dd($users->toArray());
    return view('admins.users.manager-users', compact('users'));
  }

  /**
   * Delete user
   */
  public function deleteUser($id)
  {
    // get booking with approve and pending status
    $booking = Booking::where('user_id', $id)
      ->whereIn('status', [Booking::APPROVE_STATUS, Booking::PENDING_STATUS])
      ->get();

    // IF USER HAVE BOOKING STATUS not have PENDING OR APPROVE can delete
    if ($booking->count() == 0) {
      DB::beginTransaction();

      try {
        // get current booking of user
        $user = $this->model->with(['bookings'])->find($id);

        if ($user->bookings->count() != 0) { // if user have booking then delete booking
          // Get all bookings of user include booking detail
          $user_bookings = Booking::with('bookingDetails')->where('user_id', $id)->get();

          //if user have booking then delete
          if ($user_bookings->count() != 0) {
            // Delete booking detail with booking id first then delete booking with booking id
            foreach ($user_bookings as $val) {
              if ($val->bookingDetails->count() != 0) {   //if bookingDetail not null(for sure)
                BookingDetail::where('booking_id', $val->id)->delete();
                Booking::destroy($id);
              } else {
                //only delete booking with booking id
                Booking::destroy($id);
              }
            }
          };
        }
        // Delete comment of user
        Comment::where('user_id', $id)->delete();
        //Delete profile  with user_id = $id
        $profile = Profile::where('user_id', $id)->delete();
        if ($profile) { // if delete profile success
          // Then delete user with $id
          $this->model->destroy($id);
        }

        //commit
        DB::commit();
        return redirect()->back()->with(['status' => 'Delete success!']);
      } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with(['status' => 'Something went wrong, please try again!']);
      }
    } else {
      return redirect()->back()->with(['status' => 'Delete fail!(May be user have booking in system!)']);
    }
  }
}
