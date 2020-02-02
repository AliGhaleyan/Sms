<?php
/**
 * Created by SERJIK
 */

namespace Serjik\Sms;

/**
 * Class BaseSmsDriver
 * @package Serjik\Sms
 */
abstract class BaseSmsDriver
{
    protected $serviceName;
    protected $service;
    protected $config = [];
    protected $number = [];

    /**
     * set number or numbers to send message
     *
     * @param $number
     * @return $this
     */
    public function to($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * get contact numbers
     *
     * @return array
     */
    public function getContact()
    {
        return $this->number;
    }

    /**
     * send single sms
     * send message to mobile number
     *
     * @param $message
     * @return mixed
     */
    final public function send($message)
    {
        if (!class_exists($this->serviceName)) throw new \Exception("not installed the driver package or invalid property serviceName");
        $this->connection();
        $contacts = $this->getContact();
        if (is_array($contacts)) {
            return $this->handleBulk($contacts, $message);
        } else {
            return $this->handle($contacts, $message);
        }
    }

    /**
     * send sms in this method
     *
     * @param $contacts
     * @param $message
     * @return mixed
     */
    abstract public function handle($contact, $message);

    /**
     * send bulk sms
     *
     * @param $contacts
     * @param $message
     * @return mixed
     */
    abstract public function handleBulk($contacts, $message);

    /**
     * action connect to api master
     *
     * @return mixed
     */
    abstract public function connection();

    /**
     * get config
     *
     * @param bool $configName
     * @return array|mixed
     */
    public function getConfig($configName = false)
    {
        if ($configName === false)
            return $this->config;
        else
            return $this->config[$configName];
    }

    /**
     * set or merge config
     *
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config)
    {
        $this->config = array_merge($config, $this->getConfig());
        return $this;
    }

    /**
     * get config
     *
     * @param $name
     * @return array|mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        if ($property = $this->getConfig($name)) {
            return $property;
        } else {
            throw new \Exception("cannot find property {$name}");
        }
    }
}
