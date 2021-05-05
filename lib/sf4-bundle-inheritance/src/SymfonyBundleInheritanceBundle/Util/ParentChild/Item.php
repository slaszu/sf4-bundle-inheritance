<?php

declare(strict_types=1);

namespace SymfonyBundleInheritanceBundle\Util\ParentChild;

use Symfony\Component\HttpKernel\Bundle\BundleInterface;

class Item
{
    private BundleInterface $parent;

    private BundleInterface $child;

    public function __construct(BundleInterface $parent, BundleInterface $child)
    {
        $this->parent = $parent;
        $this->child = $child;
    }

    public function getParent(): BundleInterface
    {
        return $this->parent;
    }

    public function getChild(): BundleInterface
    {
        return $this->child;
    }
}