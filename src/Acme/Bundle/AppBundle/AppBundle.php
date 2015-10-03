<?php

namespace Acme\Bundle\AppBundle;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class AppBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new RegisterListenersPass('domain.event_dispatcher', 'domain.event_listener', 'domain.event_subscriber'), PassConfig::TYPE_BEFORE_REMOVING);
    }
}
