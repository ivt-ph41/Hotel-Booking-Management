<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoomRepository.
 *
 * @package namespace App\Repositories;
 */
interface RoomRepository extends RepositoryInterface
{
    public function filterRoom(Request $request);
}
