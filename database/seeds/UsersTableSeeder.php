<?php

use Illuminate\Database\Seeder;

use App\Todo;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,5)->create()->each(function($u){
            $u->todos()->save(factory(Todo::class )->make());

        });
    }
}
