<?php

namespace FLEdev\NoCaptcha\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class NoCaptchaExtension extends Extension
{

    /**
     * Loading services.yml and configuration
     *
     * @param array            $configs   -
     * @param ContainerBuilder $container -
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('no_captcha.config', $config);

        $resources = $container->getParameter('twig.form.resources');
        $templateParameters = array_merge(array('NoCaptchaBundle::captcha.html.twig'), $resources);
        $container->setParameter('twig.form.resources', $templateParameters);
    }
}