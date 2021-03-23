<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\RoomRepository::class, \App\Repositories\RoomRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BedRepository::class, \App\Repositories\BedRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ImageRepository::class, \App\Repositories\ImageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TypeRepository::class, \App\Repositories\TypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProfileRepository::class, \App\Repositories\ProfileRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoleRepository::class, \App\Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BookingRepository::class, \App\Repositories\BookingRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PersonRoomRepository::class, \App\Repositories\PersonRoomRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CommentRepository::class, \App\Repositories\CommentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
