<?php

namespace App\Repositories;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * Register normal user
     */
    public function register(RegisterUserRequest $request);

    /**
     * Change password for user authenticated
     */
    public function updatePassword(ChangePasswordRequest $request);
}
