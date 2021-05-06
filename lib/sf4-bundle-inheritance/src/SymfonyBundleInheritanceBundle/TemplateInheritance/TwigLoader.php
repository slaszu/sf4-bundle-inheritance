<?php

declare(strict_types=1);

namespace SymfonyBundleInheritanceBundle\TemplateInheritance;

use SymfonyBundleInheritanceBundle\Util\ParentChild\Collection;
use Twig\Loader\FilesystemLoader;

class TwigLoader extends FilesystemLoader
{
    public function initInheritance(Collection $parentChildCollection): void
    {
        foreach ($parentChildCollection->getItems() as $item) {
            $parent = $item->getParent();
            $child = $item->getChild();

            $namespace = $this->normalizeBundleName($parent->getName());
            $path = $child->getPath() . '/Resources/views';

            if (file_exists($path)) {
                $this->setPaths([$path], $namespace);
            }
        }
    }

    /**
     * This is the same logic like in resource:
     * \Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension::normalizeBundleName
     *
     * @param string $name
     * @return string
     */
    private function normalizeBundleName(string $name): string
    {
        if ('Bundle' === substr($name, -6)) {
            $name = substr($name, 0, -6);
        }

        return $name;
    }
}