<?php

use App\Models\User;

it('Loings in a user', function () {

    $user = User::factory()->create([
        'email' => 'john@gmail.com',
        'password' => '12345678']);

    visit('/login')
        ->fill('email', 'john@gmail.com')
        ->fill('password', '12345678')
        ->click('@login-button')
        ->assertPathIs('/');

    $this->assertAuthenticated();

});

it('Logs out a user', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    visit('/')
        ->click('Log Out');

    $this->assertGuest();

});
