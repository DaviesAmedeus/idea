<?php

use Illuminate\Support\Facades\Auth;

it('Registers a user', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'john@gmail.com')
        ->fill('password', '12345678')
        ->click('Create Account')
        ->assertPathIs('/');

    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([
        'name' => 'John Doe',

    ]);

});
