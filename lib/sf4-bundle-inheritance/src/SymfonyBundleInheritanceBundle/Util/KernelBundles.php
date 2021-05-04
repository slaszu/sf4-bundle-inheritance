<?php

declare(strict_types=1);

namespace SymfonyBundleInheritanceBundle\Util;

class KernelBundles
{
    protected array $kernelBundles = [];

    public function __construct(array $kernelBundles)
    {
        $this->kernelBundles = $kernelBundles;
    }

    /**
     * @return array
     */
    public function getKernelBundles(): array
    {
        return $this->kernelBundles;
    }


}