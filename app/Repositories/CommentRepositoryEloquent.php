<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CommentRepository;
use App\Entities\Comment;
use App\Validators\CommentValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

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

    public function showTableManager(Request $request)
    {
        // If request has search
        if ($request->has('search')) {
            $data = $request->input('search');

            $comments = $this->model->with(['user', 'room'])->whereHas('user', function (Builder $query) use ($data) {
                return $query->where('email', 'LIKE', "%$data%");
            })->orWhereHas('room', function (Builder $query) use ($data) {
                return $query->where('name', 'LIKE', "%$data%");
            })
                ->paginate(5);

            $comments->appends([
                'search' => $request->input('search')
            ]);
            if (count($comments) == 0) { // if not have result
                return redirect()->back()->with(['no result found' => 'No Result Found!']);
            }
            return view('admins.comments.manager', compact('comments'));
        }
        // Default
        $comments = $this->model->with('user', 'room')->paginate(5);
        return view('admins.comments.manager', compact('comments'));
    }
}
