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
use App\Entities\Role;

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
    // Validate form comment
    $request->validate([
      'content' => 'required'
    ]);
    if (Auth::check()) { // If user has login then can store comment
      $user_id = Auth::user()->id;
      // Get value all filed except field '_token'
      $data = $request->except('_token');
      $data['user_id'] = $user_id; // add user_id to array $data
      $data['room_id'] = $room_id; // add room_id to array $data
      $this->model->create($data);
    }
  }

  public function showTableManager(Request $request)
  {
    // If request has search
    if ($request->has('search')) {
      $data = $request->input('search'); // Set value $data == input search field
      // get comment with user and room where like email of user or where has name of room via relationship
      $comments = $this->model->with(['user', 'room'])->whereHas('user', function (Builder $query) use ($data) {
        return $query->where('role_id', Role::USER_ROLE)// where role  is user
                     ->where('email', 'LIKE', "%$data%");
      })->orWhereHas('room', function (Builder $query) use ($data) {
        return $query->where('name', 'LIKE', "%$data%");
      })->paginate(5);

      // Append to the query string of pagination links
      $comments->appends([
        'search' => $request->input('search')
      ]);

      // if not have result
      if (count($comments) == 0) {
        $noResultFound = '';
        // dd($bookings->toArray());
        return view('admins.comments.manager', compact('comments', 'noResultFound'));
      }
      // get total of result
      $totalResult = $comments->total();

      // return $bookings with search query and display total result
      return view('admins.comments.manager', compact('comments', 'totalResult'));
    }
    // Default returl all comments order by descending and paginate 5 record/page
    $comments = $this->model->with(['user', 'room'])->whereHas('user', function($query){
      return $query->where('role_id', Role::USER_ROLE);
    })->orderBy('id', 'desc')->paginate(5);
    return view('admins.comments.manager', compact('comments'));
  }
}
