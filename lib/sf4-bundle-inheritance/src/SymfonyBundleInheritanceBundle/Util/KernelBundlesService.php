<?php

declare(strict_types=1);

namespace SymfonyBundleInheritanceBundle\Util;

use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use SymfonyBundleInheritanceBundle\Util\Dto\InheritanceBundleDto;

class KernelBundlesService
{
    protected KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @return BundleInterface[]
     */
    public function getKernelBundles(): array
    {
        return $this->kernel->getBundles();
    }

    public function getKernelBundle(string $name): BundleInterface
    {
        return $this->kernel->getBundle($name);
    }

    /**
     * @return BundleHierarchyCollection
     */
    public function getBundleHierarchyCollection(): BundleHierarchyCollection
    {
        $methodName = 'getParent';

        $hasChild = [];
        $bundleHierarchyCollection = new BundleHierarchyCollection();
        foreach ($this->getKernelBundles() as $bundle) {
            $bundleHierarchyCollection->set($bundle->getName(), [$bundle]);

            if (method_exists($bundle, $methodName)) {
                $parentBundleName = $bundle->{$methodName}();
                $parentBundle = $this->getKernelBundle($parentBundleName);
                $hasChild[$parentBundle->getName()] = $bundle;
            }
        }

        foreach($hasChild as $bundleName => $childBundle) {
            $bundleHierarchyCollection->add($bundleName, $childBundle);
        }

        return $bundleHierarchyCollection;
    }


}