<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Role.
 *
 * @package namespace App\Entities;
 */
class Role extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    const ADMIN_ROLE = 1;
    const USER_ROLE = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * ONE TO ONE: ROLE WITH USER
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
