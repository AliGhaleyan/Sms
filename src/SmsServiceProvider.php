<?php
/**
 * Created by SERJIK
 */

namespace Serjik\Sms;

use \Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . "/../config/sms.php" => config_path('sms.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__ . "/../config/sms.php", 'sms'
        );
    }
}
