<?php

namespace Tests\Traits;

use Laravel\Dusk\Browser;

trait FilamentAuth
{
    public function loginAsAdmin(Browser $browser): Browser
    {
        $browser->driver->manage()->deleteAllCookies();

        return $browser
            ->visit('/admin/login')
            ->type('[id="form.email"]', 'admin@gmail.com')
            ->type('[id="form.password"]', 'password')
            ->press('Sign in')
            ->waitForLocation('/admin', 10);
    }
}
