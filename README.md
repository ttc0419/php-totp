# PHP TOTP
A simple, fast HMAC-SHA1 6-digit TOTP(Time-Based One-Time Password) implementation in PHP that refreshes once per 30 seconds.

## Installation
Since it does not available as a composer/pecl package.  You can just copy ```totp.php``` to your project's library directory
and import it using ```require_once```.

## Quick Start
```php
<?php
require_once 'totp.php';

if (!totp_verify($_GET['opt'], 'secret')) {
    /* The one time password is not valid */
}
```

## Sponsor
It takes a lot of time to create and maintain a project.  If you think it helped you, could you buy me a cup of coffee? 😉  
You can use any of the following methods to donate:

| [![PayPal](/img/paypal.svg)](https://www.paypal.com/paypalme/tianchentang)<br/>Click [here](https://www.paypal.com/paypalme/tianchentang) to donate | ![Wechat Pay](/img/wechat.jpg)<br/>Wechat Pay | ![Alipay](/img/alipay.jpg) Alipay |
|-----------------------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------|-----------------------------------|
