<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BookingDetailRepository;
use App\Entities\BookingDetail;
use App\Validators\BookingDetailValidator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BookingDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BookingDetailRepositoryEloquent extends BaseRepository implements BookingDetailRepository
{
  /**
   * Specify Model class name
   *
   * @return string
   */
  public function model()
  {
    return BookingDetail::class;
  }



  /**
   * Boot up the repository, pushing criteria
   */
  public function boot()
  {
    $this->pushCriteria(app(RequestCriteria::class));
  }

  
}
