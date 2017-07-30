<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class TodoTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */


    public function testRegister()
    {

        $this->browse(function ($browser) {
            $browser->visit('register')
                ->type('name', 'Ivona Milanova')
                ->type('email', 'ivona@laravel.com')
                ->type('password', 'v0xtene0')
                ->type('password_confirmation', 'v0xtene0')
                ->press('Register')
                ->assertPathIs('/todo');
        });
    }

    public function testCreateTodo()
    {
        $this->browse(function ($browser) {
            $browser->visit('todo')
                ->type('task', 'Testing it With Dusk')
                ->type('date', 'dusk')
                ->type('description', 'This is created with dusk')
                ->press('Add')
                ->assertPathIs('/todoapplaravel/public/todo');
        });
    }

    public function testViewTodo()
    {
        $this->browse(function ($browser) {
            $browser->visit('todo')
                ->assertVisible('#spesView')
                ->visit(
                    $browser->attribute('#spesView', 'href')
                )
                ->assertPathIs('/todo/' + $browser->value('date'))
                ->type('description', 'Testing it with dusk again')
                ->press('Update')
                ->assertPathIs('/todoapplaravel/public/todo/1');
        });
    }

    public function testFileUpload()
    {

        $this->browse(function ($browser) {
            $user = factory(User::class)->create();

            $this->actingAs($user)
                ->visit('/todo/' + \Carbon\Carbon::now()->format('Y-m-d'))
                ->attach('photo', 'app/public/images/matrix.png')
                ->press('save');

            $value = $browser->value('name');


            $this->seeInDatabase('todos', ['image' => 'matrix.png', 'task' => 'name']);

        });
    }
}
