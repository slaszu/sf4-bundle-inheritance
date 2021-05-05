<?php

declare(strict_types=1);

namespace App\OtherBundle\Service;

use SymfonyBundleInheritanceBundle\Util\KernelBundlesService;

class RandomNumberService
{
    private array $params = [];

    private KernelBundlesService $kernelBundles;

    public function __construct(array $params = [], KernelBundlesService $kernelBundles)
    {
        $this->params = $params;
        $this->kernelBundles = $kernelBundles;
    }

    public function __toString(): string
    {
        dump($this->kernelBundles->getKernelBundles());
        dump($this->kernelBundles->getBundleHierarchyCollection());
        $this->params['random'] = rand(1000, 9999);
        return var_export($this->params, true);
    }
}