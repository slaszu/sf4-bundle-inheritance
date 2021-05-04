<?php
declare(strict_types=1);

namespace App\PageBundle\Service;

class RandomNumberService
{
    private array $params = [];

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function __toString(): string
    {
        $this->params['random'] = rand(1000,9999);
        return var_export($this->params, true);
    }
}