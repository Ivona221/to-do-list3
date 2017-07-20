<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Todo;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\ToDo'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        //$schedule->command('emails:task')->everyMinute();
        /*$schedule->call(function () {
            $user = \App\User::findOrFail(8);

            Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {


                $m->to($user->email, $user->name)->subject('Your Reminder!');
            });
        })->everyMinute();*/
        /*$schedule->command('emails:send')->daily()->emailOutputTo(Auth::user()->email)->when(function () {
            $todos=\App\Todo::where(['end_time','.>=',\Carbon\Carbon::now()->subMinute(5)->format('H:i:s'),'end_time','<=',\Carbon\Carbon::now()->format('H:i:s')]);
            if(!is_null($todos)){
            return true;}
            else
                return false;
        });*/

        $schedule->command('email:task ')->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
