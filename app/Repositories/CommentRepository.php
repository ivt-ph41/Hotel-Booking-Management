<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CommentRepository.
 *
 * @package namespace App\Repositories;
 */
interface CommentRepository extends RepositoryInterface
{
  public function storeComment($room_id, Request $request);

  /**
   * Show table manager comment
   *
   * @param  mixed $request
   * @return void
   */
  public function showTableManager(Request $request);
}
