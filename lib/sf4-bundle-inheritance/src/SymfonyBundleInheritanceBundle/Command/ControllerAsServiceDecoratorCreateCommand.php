<?php

declare(strict_types=1);

namespace SymfonyBundleInheritanceBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Routing\RouterInterface;
use SymfonyBundleInheritanceBundle\Util\Normalizer;
use SymfonyBundleInheritanceBundle\Util\ParentChild\Collection;

class ControllerAsServiceDecoratorCreateCommand extends Command
{
    private RouterInterface $router;

    private Container $container;

    private Normalizer $normalizer;

    private Collection $parentChildCollection;

    public function __construct(
        RouterInterface $router,
        Container $container,
        Normalizer $normalizer,
        Collection $parentChildCollection
    ) {
        parent::__construct();

        $this->router = $router;
        $this->container = $container;
        $this->normalizer = $normalizer;
        $this->parentChildCollection = $parentChildCollection;
    }

    public function run(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Checking routes ...');
        $routeCollection = $this->router->getRouteCollection();

        $limit = 500;
        $cnt = 0;

        $controllerAsServiceArray = [];

        foreach ($routeCollection as $name => $route) {
            if ($cnt++ >= $limit) {
                //break;
            }

            $output->writeln(sprintf('... route "%s":', $name));

            $routeController = $route->getDefault('_controller');
            if ($routeController === null) {
                $output->writeln(sprintf('...... has not _controller, check it'));
                continue;
            }
            $possibleServiceName = $this->normalizer->getControllerServiceName($routeController);

            if (isset($controllerAsServiceArray[$possibleServiceName])) {
                continue;
            }

            if ($possibleServiceName === null) {
                $output->writeln(sprintf('...... has not valid _controller "%s", check it', $routeController));
                continue;
            }

            if (!$this->container->has($possibleServiceName)) {
                //$output->writeln(sprintf('...... has _controller "%s" not in container_service on id "%s", check it', $routeController, $possibleServiceName));
                continue;
            }

            $service = $this->container->get($possibleServiceName);
            $controllerAsServiceArray[$possibleServiceName] = get_class($service);
        }

        $controllerAsServiceToDecorate = [];

        $output->writeln('Checking bundle inheritance ...');
        foreach ($this->parentChildCollection->getItems() as $item) {
            $parent = $item->getParent();
            $child = $item->getChild();
            $output->writeln(sprintf('... parent "%s"', $parent->getNamespace()));

            foreach ($controllerAsServiceArray as $serviceId => $className) {
                if (strpos($className, $parent->getNamespace()) === 0) {
                    $output->writeln(
                        sprintf('...... possible service to decorate : "%s"[%s] ', $className, $serviceId)
                    );
                    $childControllerClassExists = $this->searchControllersInBundle(
                        $parent->getNamespace(),
                        $child->getNamespace(),
                        $className
                    );

                    if ($childControllerClassExists !== null) {
                        $output->writeln(sprintf('****** childe controller class "%s"', $childControllerClassExists));
                        $controllerAsServiceToDecorate[] = [
                            'class' => $childControllerClassExists,
                            'decorate' => $serviceId,
                        ];
                    }
                }
            }
        }

        foreach($controllerAsServiceToDecorate as $toDecorate) {
            
        }
        return 1;
    }

    private function searchControllersInBundle(
        string $parentNamespace,
        string $childNamespace,
        string $parentControllerClass
    ): ?string {
        $childControllerName = str_replace($parentNamespace, $childNamespace, $parentControllerClass);
        if (class_exists($childControllerName)) {
            return $childControllerName;
        }

        return null;
    }
}