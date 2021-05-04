<?php

declare(strict_types=1);

namespace App\PageExtendBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PageExtendBundle extends Bundle
{
    public function getParent(): string
    {
        return 'PageBundle';
    }
}