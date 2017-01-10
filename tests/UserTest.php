<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanBeCreated()
    {
        $user = factory(App\Models\User::class)->create([
            'name' => 'Vladislav',
        ]);

        $this->assertEquals($user->name, 'Vladislav');

        $this->seeInDatabase('users', ['id' => '1', 'name' => 'Vladislav']);
    }
}
