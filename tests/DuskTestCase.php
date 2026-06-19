<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Collection;
use Laravel\Dusk\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\BeforeClass;

abstract class DuskTestCase extends BaseTestCase
{
    /**
     * Prepare for Dusk test execution.
     */
    #[BeforeClass]
    public static function prepare(): void
    {
        if (! static::runningInSail()) {
            static::startChromeDriver(['--port=9515']);
        }
    }

    /**
     * Create the RemoteWebDriver instance.
     */
protected function driver(): RemoteWebDriver
{
    $options = (new ChromeOptions)->addArguments([
        '--disable-search-engine-choice-screen',
    ]);

    $options->setBinary(
        '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome'
    );

    return RemoteWebDriver::create(
        'http://localhost:9515',
        DesiredCapabilities::chrome()->setCapability(
            ChromeOptions::CAPABILITY,
            $options
        )
    );
}
}
