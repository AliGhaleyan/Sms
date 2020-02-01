<?php
/**
 * Created by SERJIK
 */

namespace Serjik\Sms\Drivers;

use Kavenegar\KavenegarApi;
use Serjik\Sms\BaseSmsDriver;

/**
 * Class Kavenegar
 * @package Serjik\Sms\Drivers
 *
 * @property KavenegarApi $service
 */
class Kavenegar extends BaseSmsDriver
{
    protected $serviceName = "Kavenegar\KavenegarApi";

    public function handle($contact, $message)
    {
        return $this->service->Send($this->getConfig('line_number') ,$contact, $message);
    }
}
