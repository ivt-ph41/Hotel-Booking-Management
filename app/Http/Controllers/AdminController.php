<?php

namespace App\Http\Controllers;

use App\Repositories\RoomRepository;
use App\Repositories\UserRepository;
class AdminController extends Controller
{
    protected $userRepository;
    protected $roomRepository;

    public function __construct(UserRepository $userRepository, RoomRepository $roomRepository)
    {
        $this->userRepository = $userRepository;
        $this->roomRepository = $roomRepository;
    }

    /**
     *  Return view Dashboard of admin
     */
    public function dashboard ()
    {
        return view('admins.dashboard');
    }

}
