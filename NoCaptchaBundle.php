<?php

namespace FLEdev\NoCaptcha;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use \FLEdev\NoCaptcha\DependencyInjection\NoCaptchaExtension;

class NoCaptchaBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new NoCaptchaExtension();
    }

    /**
     * @return string
     */
    protected function getContainerExtensionClass()
    {
        $bundleName = $this->getNamespace().'\\DependencyInjection\\'.$this->getName().'Extension';
        return $bundleName;
    }
}