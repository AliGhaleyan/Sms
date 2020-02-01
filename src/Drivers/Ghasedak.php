<?php
/**
 * Created by SERJIK
 */

namespace Serjik\Sms\Drivers;


use Ghasedak\GhasedakApi;
use Serjik\Sms\BaseSmsDriver;

/**
 * Class Ghasedak
 * @package Serjik\Sms\Drivers
 *
 * @property GhasedakApi $service
 */
class Ghasedak extends BaseSmsDriver
{
    protected $serviceName = "Ghasedak\GhasedakApi";

    public function handle($contact, $message)
    {
        return $this->service->SendSimple($contact, $message,$this->getConfig('line_number'));
    }
}
