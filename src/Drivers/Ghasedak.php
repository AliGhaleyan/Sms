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

    public function connection()
    {
        $this->service = new $this->serviceName($this->getConfig('api_key'));
    }

    public function handle($contact, $message)
    {
        return $this->service->SendSimple($contact, $message, $this->getConfig('line_number'));
    }

    public function handleBulk($contacts, $messages)
    {
        $copy = $contacts;
        $firstKey = key(array_splice( $copy, 0, 1 ));
        $lineNumbers = array_fill($firstKey, count($contacts), $this->getConfig('line_number'));
        return $this->service->SendBulk($lineNumbers, $contacts, $messages, []);
    }
}
