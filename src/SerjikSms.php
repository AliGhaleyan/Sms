<?php
/**
 * Created by SERJIK
 */

namespace Serjik\Sms;

class SerjikSms
{
    /**
     * set driver
     *
     * @param $driver
     * @return mixed|string
     * @throws \Exception
     */
    public function driver($driver = null)
    {
        if (is_null($driver)) {
            $driver = config('sms.driver');
        }

        $drivers = config('sms.drivers');
        $config = $drivers[$driver];

        if (isset($config['provider'])) {
            $driverClass = $config['provider'];
        } else {
            $namespace = 'Serjik\\Sms\\Drivers\\';
            $driverClass = $namespace . ucfirst($driver);
            if (!class_exists($driverClass)) {
                $list = require __DIR__ . "/drivers.php";
                $driverClass = $list[$driver];
            }
        }

        if (!class_exists($driverClass)) throw new \Exception("{$driverClass} not exists!");

        /** @var BaseSmsDriver $driverClass */
        $driverClass = new $driverClass($config);
        if (is_callable([$driverClass, 'setConfig'])) $driverClass->setConfig($config);
        if (isset($config['service'])) $driverClass->setService($config['service']);
        if (is_callable([$driverClass, 'setService'])) $driverClass->instance();

        return $driverClass;
    }

    public function __call($method, $params)
    {
        return $this->driver()->$method(...$params);
    }
}
