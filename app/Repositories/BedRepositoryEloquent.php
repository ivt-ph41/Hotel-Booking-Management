<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BedRepository;
use App\Entities\Bed;
use App\Validators\BedValidator;

/**
 * Class BedRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BedRepositoryEloquent extends BaseRepository implements BedRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Bed::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
