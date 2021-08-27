<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\User;

class UserTests extends TestCase
{

    /**
     * Test creating a user
     *
     * @return void
     */
    public function testCreateSuccess()
    {
        $this->json('POST', '/users', [
            'first_name' => 'Daniel',
            'last_name' => 'Scott',
            'email' => 'daniel@test.com',
            'opt_in' => '1'
            ])
            ->seeJson([
                'first_name' => 'Daniel',
                'last_name' => 'Scott',
                'email' => 'daniel@test.com',
                'opt_in' => '1'
            ]);
    }

    /**
     * Test creating a user with incomplete payload
     *
     * @return void
     */
    public function testCreateFailure()
    {
        $this->json('POST', '/users', [
            'first_name' => 'Daniel',
            'last_name' => 'Scott',
            'email' => 'daniel@test.com',
        ])
            ->seeJson(json_decode('{"code":422,"error":{"opt_in":["The opt in field is required."]}}', true));
    }

    /**
     * Test setting opt-in to opposite value
     *
     * @return void
     */
    public function testUpdateOptIn()
    {
        $user = User::findOrFail(1);
        $valueToSet = !$user->opt_in;
        $this->json('PATCH', "/users/1?opt_in=$valueToSet");

        $updatedUser = User::findOrFail(1);
        $this->assertEquals($valueToSet, $updatedUser->opt_in);
    }

}
