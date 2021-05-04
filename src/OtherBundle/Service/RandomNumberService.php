<?php
declare(strict_types=1);

namespace App\OtherBundle\Service;

use SymfonyBundleInheritanceBundle\Util\KernelBundles;

class RandomNumberService
{
    private array $params = [];

    private KernelBundles $kernelBundles;

    public function __construct(array $params = [], KernelBundles $kernelBundles)
    {
        $this->params = $params;
        $this->kernelBundles = $kernelBundles;
    }

    public function __toString(): string
    {
        dump($this->kernelBundles);
        $this->params['random'] = rand(1000,9999);
        return var_export($this->params, true);
    }
}