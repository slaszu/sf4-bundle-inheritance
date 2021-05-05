<?php

declare(strict_types=1);

namespace App\OtherBundle\Service;

use SymfonyBundleInheritanceBundle\Util\ParentChild\Collection;

class RandomNumberService
{
    private array $params = [];

    private Collection $collection;

    public function __construct(array $params = [], Collection $collection)
    {
        $this->params = $params;
        $this->collection = $collection;
    }

    public function __toString(): string
    {
        dump($this->collection);
        $this->params['random'] = rand(1000, 9999);
        return var_export($this->params, true);
    }
}