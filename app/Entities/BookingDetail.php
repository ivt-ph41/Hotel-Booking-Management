<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BookingDetail.
 *
 * @package namespace App\Entities;
 */
class BookingDetail extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_id',
        'date_start',
        'date_end',
        'booking_id'
    ];

    /*
        ONE TO ONE
        BOOKING HAS ONE BOOKING DETAIL
    */
    public function booking()
    {
        return $this->belongsTo('App\Entities\Booking');
    }

    /*
        ONE TO MANY
        ROOM HAS MANY BOOKING DETAIL
    */
    public function room()
    {
        return $this->belongsTo('App\Entities\Room');
    }
}
