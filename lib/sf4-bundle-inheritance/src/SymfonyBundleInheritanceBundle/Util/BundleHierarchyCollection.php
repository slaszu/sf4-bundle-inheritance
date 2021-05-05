<?php

declare(strict_types=1);

namespace SymfonyBundleInheritanceBundle\Util;

use InvalidArgumentException;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;

class BundleHierarchyCollection
{
    private array $collection = [];

    /**
     * @param string $bundleName
     * @param BundleInterface[] $bundles
     */
    public function set(string $bundleName, array $bundles): void
    {
        $this->clear($bundleName);
        foreach ($bundles as $bundle) {
            $this->add($bundleName, $bundle);
        }
    }

    public function add(string $bundleName, BundleInterface $bundle): void
    {
        array_unshift($this->collection[$bundleName], $bundle);
    }

    public function clear(string $bundleName): void
    {
        $this->collection[$bundleName] = [];
    }

    /**
     * @param string $bundleName
     * @return BundleInterface[]
     */
    public function getBundles(string $bundleName): array
    {
        return $this->collection[$bundleName] ?? [];
    }

}