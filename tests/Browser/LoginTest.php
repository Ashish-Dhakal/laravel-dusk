<?php

use Laravel\Dusk\Browser;

test('user can login', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/admin/login')
            ->type('[id="form.email"]', 'admin@gmail.com')
            ->type('[id="form.password"]', 'password')
            ->press('Sign in')
            ->waitForLocation('/admin')
            ->assertPathIs('/admin');
    });
});
