<?php

declare(strict_types=1);

namespace SymfonyBundleInheritanceBundle\ControllerInheritance;

use Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver as BaseControllerResolver;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use SymfonyBundleInheritanceBundle\Util\BundleHierarchyCollection;
use SymfonyBundleInheritanceBundle\Util\ParentChild\Collection;
use SymfonyBundleInheritanceBundle\Util\ParentChild\Item;

class ControllerResolver extends BaseControllerResolver
{
    protected Collection $parentChildCollection;

    public function setParentChildCollection(Collection $parentChildCollection): void
    {
        $this->parentChildCollection = $parentChildCollection;
    }

    protected function getChildControllerIfOverride(string $controller): string
    {
        $parentChildItems = $this->parentChildCollection->getItems();
        foreach ($parentChildItems as $parentChildItem) {
            if (strpos($controller, $parentChildItem->getParent()->getNamespace()) !== false) {
                return $this->checkChildController($controller, $parentChildItem);
            }
        }

        return $controller;
    }

    protected function checkChildController(
        string $controller,
        Item $parentChildItem
    ): string {

        // method remove
        $parts = explode('::', $controller);
        if (count($parts) != 2) {
            // we dont know how to process this format
            return $controller;
        }

        [$controllerName, $methodName] = $parts;

        // remove parent namespace
        // add child namespace

        $controllerChild = str_replace(
            $parentChildItem->getParent()->getNamespace(),
            $parentChildItem->getChild()->getNamespace(),
            $controllerName
        );

        // check if file exists
        if (class_exists($controllerChild)) {
            return $controllerChild.'::'.$methodName;
        }

        return $controller;
    }


    protected function createController($controller)
    {
        $controller = $this->getChildControllerIfOverride($controller);

        return parent::createController($controller); // TODO: Change the autogenerated stub
    }

}