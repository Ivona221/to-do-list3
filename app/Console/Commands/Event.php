<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Ocasion;
use App\User;

class Event extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to all the invited users';

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

        /*$occasions =Ocasion::all();
        $i=0;
        foreach($occasions as $occasion) {
            $users[$i++] = $occasion->usersList();

            foreach ($users as $user) {
                foreach ($user as $u) {
                    Mail::send('emails.event', ['occasion' => $occasion->name,'place'=>$occasion->place,'time'=>$occasion->time,'date'=>$occasion->date], function ($m) use ($u) {


                        $m->to($u, $u)->subject('Invitation!');
                    });
                }
            }

        }*/

        $occasions = Ocasion::all();
        foreach ($occasions as $occasion) {

            $users = $occasion->usersEmail();
            foreach ($users as $user) {
                Mail::send('emails.event', ['occasion' => $occasion->name, 'place' => $occasion->place, 'time' => $occasion->time, 'date' => $occasion->date], function ($m) use ($user) {
                    $m->to($user, $user)->subject('Invitation!');
                });
            }
        }
    }
}