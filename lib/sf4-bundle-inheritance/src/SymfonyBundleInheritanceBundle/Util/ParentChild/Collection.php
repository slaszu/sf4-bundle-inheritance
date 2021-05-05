<?php

declare(strict_types=1);

namespace SymfonyBundleInheritanceBundle\Util\ParentChild;

class Collection
{
    private array $collection = [];

    public function set(string $bundleName, Item $parentChildDto): void
    {
        $this->collection[$bundleName] = $parentChildDto;
    }

    public function get(string $bundleName): Item
    {
        return $this->collection[$bundleName];
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return array_values($this->collection);
    }
}