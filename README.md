# NoCaptcha

###NoCaptcha Symfony Bundle

###Installation:
$ composer require FLEdev/NoCaptcha

***

Manually from: https://github.com/FLEdev/NoCaptcha

- Add to:
    - AppKernel.php
    - registerBundles()
    - new FLEdev\NoCaptcha\NoCaptchaBundle()

###Configuration:

#### config.yml:
``` 
no_captcha:
    key: '6LfV0zQUAAAAAJ1SSKBHCScJO00HLsEvr75r5N-U'
    secret: '6LfV0zQUAAAAABi-Zjp7B3ZARksGFtN38wt5UJRQ'
```

####Usage:

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
