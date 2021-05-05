<?php

declare(strict_types=1);

namespace SymfonyBundleInheritanceBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ControllerResolverPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        // TODO: Implement process() method.
    }
}