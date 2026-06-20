<?php

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\Traits\FilamentAuth;

uses(FilamentAuth::class);

test('create a user', function () {

    $this->browse(function (Browser $browser) {

        $email = 'ashish+'.Str::random(6).'@gmail.com';

        $this->loginAsAdmin($browser)
            ->waitForText('Users')
            ->click('#dusk-user-resource-nav')
            ->waitForLocation('/admin/users')

            ->visit('/admin/users/create')
            ->waitForText('Create User')

            ->type('[id="form.name"]', 'Ashish Dhakal')
            ->type('[id="form.email"]', $email)
            ->type('[id="form.phone_number"]', '1234567890')
            ->type('[id="form.date_of_birth"]', '2000-01-01')
            ->type('[id="form.address"]', '123 Main St')
            ->type('[id="form.password"]', 'password')
            ->check('[id="form.is_admin"]')

            ->press('Create')
            ->waitForText('Created');
    });
});

test('edit a user', function () {
    $user = User::factory()->create();

    $this->browse(function (Browser $browser) use ($user) {
        $email = 'ashish+'.Str::random(6).'@gmail.com';

        $this->loginAsAdmin($browser)
            ->waitForText('Users')
            ->click('#dusk-user-resource-nav')
            ->waitForLocation('/admin/users')

            ->visit("/admin/users/{$user->id}/edit")
            ->waitForText('Edit User')
            ->waitFor('[id="form.name"]', 10)

            ->type('[id="form.name"]', 'Ashish Dhakal')
            ->type('[id="form.email"]', $email)
            ->type('[id="form.phone_number"]', '1234567890')
            ->type('[id="form.date_of_birth"]', '2000-01-01')
            ->type('[id="form.address"]', '123 Main St')
            ->type('[id="form.password"]', 'password')
            ->check('[id="form.is_admin"]')

            ->press('Save')
            ->waitForText('Saved');
    });
});

test('user can view the record', function () {
    $this->browse(function (Browser $browser) {
        $this->loginAsAdmin($browser)
            ->waitForText('Users')
            ->click('#dusk-user-resource-nav')
            ->waitForLocation('/admin/users')
            ->click('#dusk-user-name');
    });
});
