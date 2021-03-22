<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Bed.
 *
 * @package namespace App\Entities;
 */
class Bed extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The Bed in many room (has many)
     *  Get the bed belong to the room
     */
    public function rooms()
    {
        return $this->hasMany('App\Entities\Room');
    }
    
}
