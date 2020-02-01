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
    protected $apiKey;
    protected $lineNumber;
    protected $serviceName;
    protected $service;
    protected $config = [];
    protected $number = [];
    protected $loop = true;

    public function __construct(array $config = [])
    {
        if (count($config)) {
            $this->apiKey = $config['api_key'];
            $this->lineNumber = $config['line_number'];
            $this->setConfig($config);
        }
    }

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
        $contacts = $this->getContact();
        if (is_array($contacts) && $this->loop) {
            $results = [];
            foreach ($contacts as $key => $contact) {
                $results[] = $this->handle($contact, is_array($message) ? $message[$key] : $message);
            }
            return $results;
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
    abstract public function handle($contacts, $message);

    /**
     * create instance of api service
     */
    public function instance()
    {
        if (class_exists($this->serviceName))
            $this->service = new $this->serviceName($this->getConfig('api_key'));
    }

    /**
     * set service class name
     *
     * @param $service
     */
    public function setService($service)
    {
        $this->serviceName = $service;
    }

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
