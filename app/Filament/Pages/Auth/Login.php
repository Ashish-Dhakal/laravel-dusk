<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Http\Responses\LoginResponse;
use Filament\Auth\Pages\Login as BaseLogin;

class Login extends BaseLogin
{
    protected function rateLimit($maxAttempts, $decaySeconds = 6, $method = null, $component = null)
    {
        parent::rateLimit(max($maxAttempts, 200), $decaySeconds, $method, $component);
    }

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(200); // 200 attempts instead of default
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return new LoginResponse;
        }

        return parent::authenticate();
    }
}
