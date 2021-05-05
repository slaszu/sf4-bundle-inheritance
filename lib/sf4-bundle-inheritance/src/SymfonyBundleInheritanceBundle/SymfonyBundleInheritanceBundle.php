<?php

declare(strict_types=1);

namespace SymfonyBundleInheritanceBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use SymfonyBundleInheritanceBundle\DependencyInjection\Compiler\ControllerResolverPass;

class SymfonyBundleInheritanceBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // controller override
        $container->addCompilerPass(new ControllerResolverPass());
    }

}
