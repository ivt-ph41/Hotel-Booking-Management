<?php

namespace App\Repositories;

use App\Http\Requests\RegisterUserRequest;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function register(RegisterUserRequest $request);
}
