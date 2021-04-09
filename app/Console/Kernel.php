<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use App\Entities\BookingDetail;
use App\Entities\Booking;

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
      // dd(Carbon::today()->toDateString());
      Booking::whereHas('bookingDetails', function ($query) {
        return $query->whereDate('date_end', '<', Carbon::today()->toDateString());
      })->update(['status' => Booking::FINISH_STATUS]);
    })->everyMinute()->runInBackground();

    // Delete finish status
    $schedule->call(function () {
      // Retrive all booking id with status 'finish'
      $bookingIds = Booking::where('status', Booking::FINISH_STATUS)->pluck('id');
      // Delete booking detail where booking id in array $bookingIds
      BookingDetail::whereIn('booking_id', $bookingIds)->delete();
      // Delete Booking where status finish
      Booking::where('status', Booking::FINISH_STATUS)->delete();
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
