<?php

namespace App\Http\Controllers;


use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditProfileRequest;
use App\Repositories\UserRepository;
use App\Repositories\ProfileRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userRepository;
    protected $profileRepository;

    public function __construct(UserRepository $userRepository, ProfileRepository $profileRepository)
    {
        $this->userRepository = $userRepository;

        $this->profileRepository = $profileRepository;

        $this->middleware('auth')->only('edit', 'update', 'changePassword', 'updatePassword');
    }

    /**
     * View profile with user authentication
     */
    public function profile()
    {
        $user = $this->userRepository->with('profile')->find(Auth::id());

        return  view('users.profile', compact('user'));
    }

    /**
     * Show view edit user profile
     */
    public function edit()
    {
        // Get current user has login by id
        $user = $this->userRepository->with('profile')->find(Auth::id());

        return view('users.edit-profile', compact('user'));
    }

    /**
     * Update profile user
     */
    public function update(EditProfileRequest $request)
    {
        $this->profileRepository->updateProfile($request);
        // Return view profile with user
        return $this->profile();
    }

    /**
     * View booking with user authentication
     */
    public function userBooking()
    {
        $user = $this->userRepository->with('bookings.bookingDetails.room')->find(Auth::id());
//        dd($user->toArray());
        return view('bookings.user-booking', compact('user'));
    }

    /**
     * SHOW FORM CHANGE PASSWORD
     */
    public function changePassword()
    {
        return view('users.change-password');
    }

    /**
     * Update password from form change password
     */
    public function updatePassword(ChangePasswordRequest $request)
    {
        return $this->userRepository->updatePassword($request);
    }
}
