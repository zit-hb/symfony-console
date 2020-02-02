<?php

namespace App;

use App\DependencyInjection\CompilerPass\CollectCommandsToApplicationCompilerPass;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as OldKernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Yaml;

final class Kernel extends OldKernel
{
    public function registerBundles(): array
    {
        return [];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__ . '/../config/services.yml');
    }

    protected function build(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addCompilerPass(new CollectCommandsToApplicationCompilerPass());
    }

    public function loadMetaData(): array
    {
        return Yaml::parseFile(__DIR__ . '/../config/application.yml');
    }
}
