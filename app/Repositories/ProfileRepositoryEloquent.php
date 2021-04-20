<?php

namespace App\Repositories;

use App\Http\Requests\EditProfileRequest;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use App\Entities\Profile;
use App\Validators\ProfileValidator;

/**
 * Class ProfileRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProfileRepositoryEloquent extends BaseRepository implements ProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Profile::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Update profile user
     */
    public function updateProfile(EditProfileRequest $request)
    {
        $result = $this->model->where('user_id', Auth::id())->update($request->except('_token', '_method'));
        if ($result) {
          $request->session()->flash('profile-success', 'Your current profile is update');
          return redirect()->route('users.profile');
        }
    }

}
