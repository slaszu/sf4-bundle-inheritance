<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => ['dev' => true, 'test' => true],
    Symfony\Bundle\MakerBundle\MakerBundle::class => ['dev' => true],
    App\PageBundle\PageBundle::class => ['all' => true],
    App\PageExtendBundle\PageExtendBundle::class => ['all' => true],
    App\OtherBundle\OtherBundle::class => ['all' => true],
    SymfonyBundleInheritanceBundle\SymfonyBundleInheritanceBundle::class => ['all' => true],
];
