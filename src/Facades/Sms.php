<?php
/**
 * Created by SERJIK
 */

namespace Serjik\Sms\Facades;


use Illuminate\Support\Facades\Facade;
use Serjik\Sms\BaseSmsDriver;

/**
 * Class Sms
 * @package Sms\src\Facades
 *
 * @method static BaseSmsDriver to($number)
 * @method static BaseSmsDriver send($message)
 * @method static BaseSmsDriver driver($driver)
 */
class Sms extends Facade
{
    /**
     * @return mixed|string
     * @throws \Exception
     */
    protected static function getFacadeAccessor()
    {
        return "Serjik\\Sms\\SerjikSms";
    }
}
