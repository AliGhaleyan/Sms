<?php
/**
 * Created by SERJIK
 */


return [
    /**
     * sms driver
     *
     * [ 'kavenegar', 'ghasedak', ... ]
     */
    'driver' => env('SMS_DRIVER'),


    /**
     * drivers config
     */
    'drivers' => [
        /**
         * for install this service on your app run this:
         *                      composer require kavenegar/php:1.2
         */
        'kavenegar' => [
            'api_key' => "kavenegar api key",
            'line_number' => "10004346",
        ],

        /**
         * for install this service on your app run this:
         *                      composer require ghasedak/php:"dev-master"
         */
        'ghasedak'  => [
            'api_key' => "ghasedak api key",
            'line_number' => "10008566",
//            'any_parameter' => 'any value',
        ],

//        EXAMPLE
//        'your_driver' => [
//            'parameters' => '',
//            'provider' => \App\Sms\YourServiceName::class,
//        ],

    ],
];
