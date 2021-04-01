<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CommentRepository;
use App\Entities\Comment;
use App\Validators\CommentValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CommentRepositoryEloquent extends BaseRepository implements CommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function storeComment($room_id, Request $request)
    {
      $request->validate([
        'content' => 'required'
      ]);
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $data = $request->except('_token');
            $data['user_id'] = $user_id;
            $data['room_id'] = $room_id;
            $this->model->create($data);
        }
    }
}
