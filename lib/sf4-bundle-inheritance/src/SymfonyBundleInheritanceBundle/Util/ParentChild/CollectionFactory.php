<?php

declare(strict_types=1);

namespace SymfonyBundleInheritanceBundle\Util\ParentChild;

use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\KernelInterface;


class CollectionFactory
{
    protected KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function getCollection(): Collection
    {
        $methodName = 'getParent';

        $bundleHierarchyCollection = new Collection();
        foreach ($this->kernel->getBundles() as $bundle) {
            if (method_exists($bundle, $methodName)) {
                $parentBundleName = $bundle->{$methodName}();
                $parentBundle = $this->kernel->getBundle($parentBundleName);

                $bundleHierarchyCollection->set($parentBundle->getName(), new Item($parentBundle, $bundle));
            }
        }

        return $bundleHierarchyCollection;
    }


}