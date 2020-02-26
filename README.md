![enter image description here](http://s7.picofile.com/file/8386817642/photo_2020_02_01_21_46_04.jpg)


## Iranian SMS

#### Easily use Iranian SMS services :)

### Installation:
```
composer require alighale/sms
```
You must add the service provider to `config/app.php`
```php
'providers' => [
	 // for laravel 5.8 and below
	 \Serjik\Sms\SmsServiceProvider::class,
];
```

**Publish your config file**

```
php artisan vendor:publish
```
<hr>

### Configuration:
> .env
```env
SMS_DRIVER=kavenegar // or another services
```

> config/sms.php
```php
    /**  
     * sms driver 
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
     'ghasedak' => [  
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
```
### Support of Iranian Sms services:
| Title | Url                        | installer |
|-------|----------------------------|-----------|
| kavenegar | [https://kavenegar.com/](https://kavenegar.com/) | `composer require kavenegar/php:1.2` |
| ghasedak | [https://ghasedak.io/](https://ghasedak.io/) | `composer require ghasedak/php:"dev-master"`

> We will add more services in the future.
> For use of services first install this package :)


## Lets start to use:

#### Single mode:

```php
//	\Serjik\Sms\Facades\Sms

/** @var BaseSmsDriver $result */
$result = Sms::to('09210125463')->send('test package');
```

#### Group mode:

 You can use the group service in two ways
> **Note:** in all send methods the result is **service** result or array of that.
 
#### The first method:
> Send a fixed message to the numbers
```php
/** @var BaseSmsDriver $result */
$result = Sms::to(['09210484017', ...])->send('test package');
```

#### The second method:
> Send number specific message.
> Send message[0] => number[0], .... and so on
```php
/** @var BaseSmsDriver $result */
$result = Sms::to(['09210484017', ...])
	->send(['test package', ....]);
```


### Driver replacement at the moment:

```php
$result = Sms::driver('driver_name')
	->to('number or array of numbers')
	->send('message or array of messages');
```
