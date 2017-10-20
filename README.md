# NoCaptcha

### NoCaptcha Symfony Bundle

### Installation:
$ composer require fledev/nocaptcha

Add to:
- AppKernel.php
  - registerBundles()
    - new FLEdev\NoCaptcha\NoCaptchaBundle()

### Configuration:

#### config.yml:
``` 
no_captcha:
    key: 'your_google_no-captcha_key'
    secret: 'your_google_no-captcha_secret'
    validation_mesage: 'Check in if you are Human'
    wrapper_class: no-captcha-wrap
    field_class: no-captcha
```

#### Usage:

- Define: 
```
use FLEdev\NoCaptcha\Form\NoCaptchaType;
```
___

- Within "buildForm" Method:

```
$builder->add('no_captcha', NoCaptchaType::class);
```

___
