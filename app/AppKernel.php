<?php

date_default_timezone_set('UTC');

use Havvg\Bundle\DRYBundle\Kernel\ContainerConfigurationRegistry;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),

            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Havvg\Bundle\DRYBundle\HavvgDRYBundle(),

            new Acme\Bundle\AppBundle\AppBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'])) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        }

        return $bundles;
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $registry = new ContainerConfigurationRegistry($this);
        $registry->register($loader);
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        $env = $this->getEnvParameters();
        if (!empty($env['kernel.cache_dir'])) {
            return $env['kernel.cache_dir'];
        }

        return implode(DIRECTORY_SEPARATOR, [
            $this->getRootDir(),
            '..', 'var', 'cache',
            $this->getEnvironment(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        $env = $this->getEnvParameters();
        if (!empty($env['kernel.logs_dir'])) {
            return $env['kernel.logs_dir'];
        }

        return implode(DIRECTORY_SEPARATOR, [
            $this->getRootDir(),
            '..', 'var', 'logs',
            $this->getEnvironment(),
        ]);
    }
}
