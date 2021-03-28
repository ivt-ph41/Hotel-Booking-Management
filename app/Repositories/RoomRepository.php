<?php

namespace App\Repositories;

use App\Http\Requests\CreateRoomRequest;
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
    public function storeRoom(CreateRoomRequest $request);
    public function showViewManagerRoom(Request $request);
    public function destroyRoom($id);
}
