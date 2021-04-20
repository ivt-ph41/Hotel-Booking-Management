<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Booking.
 *
 * @package namespace App\Entities;
 */
class Booking extends Model implements Transformable
{
  use TransformableTrait;
  use SoftDeletes;

  const PENDING_STATUS = 0;
  const APPROVE_STATUS = 1;
  const CANCEL_STATUS = 2;
  const FINISH_STATUS = 3;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'email',
    'address',
    'phone',
    'status'
  ];

  // Relation ship
  /*
    ONE TO MANY: USER WITH MANY BOOKING
    */
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function profile()
  {
  }
  /* ONE TO ONE
    BOOKING WITH BOOKING DETAIL
     */
  public function bookingDetails()
  {
    return $this->hasMany('App\Entities\BookingDetail');
  }
}
