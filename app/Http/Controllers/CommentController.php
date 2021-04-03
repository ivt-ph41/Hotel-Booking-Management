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

  /*
        STORE ELEMENT TO RESOUCES
    */
  public function store($room_id, Request $request)
  {
    $this->commentRepository->storeComment($room_id, $request);
    return redirect()->route('rooms.show', ['id' => $room_id]);
  }

  
}
