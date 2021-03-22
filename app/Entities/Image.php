<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Image.
 *
 * @package namespace App\Entities;
 */
class Image extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    protected $table = 'images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['path', 'room_id'];

    /**
     * The room has many images
     * Get the room with image
     */
    public function room()
    {
        return $this->belongsTo('App\Entities\Room');
    }
}
