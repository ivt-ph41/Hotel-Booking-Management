<?php

namespace App\Repositories;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegisterUserRequest;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
}
