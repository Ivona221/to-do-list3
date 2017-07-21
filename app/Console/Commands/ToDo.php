<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;



class ToDo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email before the task ends';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
<<<<<<< HEAD
        $todos =\App\Todo::where('end_time', '=', \Carbon\Carbon::now()->addMinute(5)->format('H:i'))->get();
        foreach ($todos as $todo) {

            $user = \App\User::findOrFail($todo->user_id);
            Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {


                $m->to($user->email, $user->name)->subject('Your Reminder!');
            });
        }
=======
        $todos=\App\Todo::where('end_date','==',\Carbon\Carbon::now()->format('Y-m-d'))->get();

        foreach( $todos as $todo ) {
            $user=User::where('id',$todo->user_id);
            if($user->has('email')) {
                Mail::to($user->email)
                    ->msg('Dear ' . $user->name . ', you have a scheduled task!')
                    ->send();
            }
        }

        $this->info('The message was sent!');
>>>>>>> 82b1a04a83cab1abb72e82a1f1a3d6aea69c063b
    }
}
