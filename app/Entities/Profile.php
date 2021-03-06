<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Profile.
 *
 * @package namespace App\Entities;
 */
class Profile extends Model implements Transformable
{
  use TransformableTrait;
  use SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'address', 'phone'];

  /*
    ONE TO ONE PROFILE BELONG TO USER
    */
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
