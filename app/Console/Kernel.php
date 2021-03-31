<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
  /**
   * The Artisan commands provided by your application.
   *
   * @var array
   */
  protected $commands = [
    //
  ];

  /**
   * Define the application's command schedule.
   *
   * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
   * @return void
   */
  protected function schedule(Schedule $schedule)
  {
    // $schedule->command('inspire')
    //          ->hourly();
    $schedule->call(function () {
      $time = Carbon::now('Asia/Ho_Chi_Minh');
      $time = $time->toTimeString();
      \App\Entities\Booking::with([
        'bookingDetails' => function ($query) use ($time) {
          return $query->where('date_end' < $time);
        }
      ])->update(['status' => \App\Entities\Booking::FINISH_STATUS]);
    })->everyMinute()->runInBackground();
  }

  /**
   * Register the commands for the application.
   *
   * @return void
   */
  protected function commands()
  {
    $this->load(__DIR__ . '/Commands');

    require base_path('routes/console.php');
  }
}
