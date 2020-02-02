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
    protected $serviceName = "\Kavenegar\KavenegarApi";

    public function connection()
    {
        $this->service = new $this->serviceName($this->getConfig('api_key'));
    }

    public function handle($contact, $message)
    {
        return $this->service->Send($this->getConfig('line_number') ,$contact, $message);
    }

    public function handleBulk($contacts, $messages)
    {
        $copy = $contacts;
        $firstKey = key(array_splice( $copy, 0, 1 ));
        $lineNumbers = array_fill($firstKey, count($contacts), $this->getConfig('line_number'));
        return $this->service->SendArray($lineNumbers, $contacts, $messages);
    }
}
