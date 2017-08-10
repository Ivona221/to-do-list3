<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Mail;

class Subscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to subscribed users';

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

        $users=User::all();
        foreach ($users as $user) {

            if($user->subscribed('main')==1) {

                Mail::send('emails.subscribe', ['user' => $user], function ($m) use ($user) {
                    $m->to($user->email, $user->name)->subject('Subscription!!!!');
                });

            }
        }



        $this->info('The message was sent!');
    }
}
