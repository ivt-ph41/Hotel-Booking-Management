<?php

namespace App\Repositories;

use App\Http\Requests\EditProfileRequest;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProfileRepository.
 *
 * @package namespace App\Repositories;
 */
interface ProfileRepository extends RepositoryInterface
{
    public function updateProfile(EditProfileRequest $request);
}
