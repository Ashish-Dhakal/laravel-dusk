<?php

namespace Tests\Traits;

use Laravel\Dusk\Browser;

trait FilamentAuth
{
    public function loginAsAdmin(Browser $browser): Browser
    {
        $browser->visit('/admin/login');

        $path = rtrim(parse_url($browser->driver->getCurrentURL(), PHP_URL_PATH), '/');
        if ($path === '/admin') {
            $browser->driver->manage()->deleteAllCookies();
            $browser->visit('/admin/login');
        }

        return $browser
            ->type('[id="form.email"]', 'admin@gmail.com')
            ->type('[id="form.password"]', 'password')
            ->press('Sign in')
            ->waitForLocation('/admin', 10);
    }
}
