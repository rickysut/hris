<?php

use Illuminate\Http\UploadedFile;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

uses()->group('controllers');
uses()->group('profile');

beforeEach(function () {
    Storage::fake('public');
});

it('updated name', function () {
    $updatedName = 'Profile testing';

    assertDatabaseMissing('moonshine_users', [
        'name' => $updatedName,
    ]);

    asAdmin()
        ->post(route('moonshine.profile.store'), [
            'name' => $updatedName,
            'username' => fake()->email(),
        ])
        ->assertValid();

    assertDatabaseHas('moonshine_users', [
        'name' => $updatedName,
    ]);
});

it('validation fail', function () {
    asAdmin()
        ->post(route('moonshine.profile.store'), [
            'name' => fake()->name(),
        ])
        ->assertInvalid(['username']);
});

it('avatar uploaded', function () {
    $avatar = UploadedFile::fake()->image('avatar.png');

    asAdmin()
        ->post(route('moonshine.profile.store'), [
            'name' => fake()->name(),
            'username' => fake()->email(),
            'avatar' => $avatar,
        ])
        ->assertValid();

    Storage::disk('public')->assertExists('moonshine_users/' . $avatar->hashName());
});
