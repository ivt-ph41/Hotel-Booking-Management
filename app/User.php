<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relation ship
    /**
     * One to one: User with role
     */
    public function role()
    {
        return $this->hasOne('App\Entities\Role');
    }

    /**
     * ONE TO ONE: USER WITH PROFILE
     */
    public function profile()
    {
        return $this->hasOne('App\Entities\Profile');
    }

    /**
     * ONE TO MANY: USER WITH BED
     */
    public function beds()
    {
        return $this->hasMany('App\Entities\Bed');
    }

    /**
     * ONE TO MANY: USER WITH COMMENT
     */
    public function comments()
    {
        return $this->hasMany('App\Entities\Comment');
    }

    /**
     * ONE TO MANY BOOKING
     */
    public function bookings()
    {
        return $this->hasMany('App\Entities\Booking');
    }
}
