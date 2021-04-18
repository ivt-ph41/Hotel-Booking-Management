<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
  protected $commentRepository;

  public function __construct(CommentRepository $commentRepository)
  {
    $this->commentRepository = $commentRepository;
  }


  /**
   * store new comment
   *
   * @param  mixed $room_id
   * @param  mixed $request
   * @return void
   */
  public function store($room_id, Request $request)
  {
    $this->commentRepository->storeComment($room_id, $request);
    return redirect()->route('rooms.show', ['id' => $room_id]);
  }

  public function destroy($id, $commentId)
  {
    $result = $this->commentRepository->where('id', $commentId)->delete();

    //if sucess then return view room detail where room id = $id
    if ($result == true) {
      $delete_comment_success = '';
      return redirect()->back()->with(['delete comment success' => 'success']);
    }

  }
}
