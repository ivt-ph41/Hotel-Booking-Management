<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Comment.
 *
 * @package namespace App\Entities;
 */
class Comment extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'room_id',
        'description'
    ];

    // RELATION SHIP
    /*
        ONE TO MANY
        USER HAS MANY COMMENTS
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * ONE TO MANY: ROOM HAS MANY COMMENTS
     */
    public function room()
    {
        return $this->belongsTo('App\Entities\Room');
    }
}
