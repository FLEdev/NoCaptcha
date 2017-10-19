<?php

namespace FLEdev\NoCaptcha\Validator;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;
use ReCaptcha\ReCaptcha;

class NoCaptchaValidator
{
    /**
     * Request property
     *
     * @var static -
     */
    private $_request;

    /**
     * Options property
     *
     * @var -
     */
    private $_options;

    /**
     * Session Property
     *
     * @var SessionInterface -
     */
    private $_session;

    /**
     * Key property
     *
     * @var -
     */
    private $_key;

    /**
     * Translation Property
     *
     * @var TranslatorInterface -
     */
    private $_translator;

    public function __construct($options, TranslatorInterface $translator, SessionInterface $session, $key)
    {
        $this->_options = $options;
        $this->_translator = $translator;
        $this->_request = Request::createFromGlobals();
        $this->_session = $session;
        $this->_key = $key;
    }

    /**
     * Validation Method
     *
     * @param FormEvent $event -
     * @return bool
     */
    public function validate(FormEvent $event)
    {
        $noCapchaResponse = $this->_request->request->get('g-recaptcha-response');
        $captchaFlag = $this->matchNoCaptcha($noCapchaResponse);
        if (!$captchaFlag) {
            $form = $event->getForm();
            $form->addError(new FormError('Validated field - NoCaptcha'));
        }
        return $captchaFlag;
    }

    /**
     * Match Request Captcha with Validation Captcha code
     *
     * @param  $responseCode -
     * @return bool
     */
    protected function matchNoCaptcha($responseCode)
    {
        $reCaptcha = new ReCaptcha($this->_options['secret']);
        $resp = $reCaptcha->verify($responseCode, $_SERVER['REMOTE_ADDR']);

        return $resp->isSuccess();
    }
}
