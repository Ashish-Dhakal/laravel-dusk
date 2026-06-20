<?php

use Laravel\Dusk\Browser;
use Illuminate\Support\Str;
use Tests\Traits\FilamentAuth;

uses(FilamentAuth::class);

test('create a user', function () {

    $this->browse(function (Browser $browser) {

        $email = 'ashish+' . Str::random(6) . '@gmail.com';

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
            ->type('[id="form.email_verified_at"]', now()->toDateTimeString())
            ->type('[id="form.password"]', 'password')
            ->check('[id="form.is_admin"]')

            ->press('Create');
    });
});
