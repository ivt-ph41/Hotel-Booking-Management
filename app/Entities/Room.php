<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Room.
 *
 * @package namespace App\Entities;
 */
class Room extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    // protected $table = 'rooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
    ];

    /**
     *
     * Get the room has owned bed
     */
    public function bed()
    {
        return $this->belongsTo('App\Entities\Bed');
    }

    /**
     * Get the room has many images
     */
    public function images()
    {
        return $this->hasMany('App\Entities\Image');
    }

    /**
     * One room have one type_room, one type room have many rooms
     */
    public function type()
    {
        return $this->belongsTo('App\Entities\Type');
    }

    /**
     * ONE TO MANY: ROOM HAS MANY COMMENT
     */
    public function comments()
    {
        return $this->hasMany('App\Entities\Comment');
    }


    public function personRoom()
    {
        return $this->belongsTo('App\Entities\PersonRoom');
    }
    /*
        ONE TO MANY
        ROOM HAS MANY BOOKING DETAIL
    */
    public function bookingDetails()
    {
        return $this->hasMany('App\Entities\BookingDetail');
    }
}
