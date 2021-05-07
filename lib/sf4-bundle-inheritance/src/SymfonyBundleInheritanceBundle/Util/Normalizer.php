<?php

declare(strict_types=1);

namespace SymfonyBundleInheritanceBundle\Util;

class Normalizer
{
    public function getControllerServiceName(string $routerControllerString, ?string $controllerMethodSeparator = null): ?string
    {
        if ($controllerMethodSeparator === null) {
            if (strpos($routerControllerString, '::') !== false) {
                return $this->getControllerServiceName($routerControllerString, '::');
            }
            if (strpos($routerControllerString, ':') !== false) {
                return $this->getControllerServiceName($routerControllerString, ':');
            }
            return null;
        }

        $parts = explode($controllerMethodSeparator, $routerControllerString);
        if (count($parts) !== 2) {
            return null;
        }

        return trim($parts[0]);
    }
}