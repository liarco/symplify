<?php declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory;
use Symplify\SmartFileSystem\Finder\FinderSanitizer;
use Symplify\SmartFileSystem\SmartFileSystem;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->public()
    ;

    $services->load('Symplify\\Autodiscovery\\', __DIR__ . '/../src')
        ->exclude([
            __DIR__ . '/../src/HttpKernel/*',
            __DIR__ . '/../src/Finder/*',
            __DIR__ . '/../src/*/*Autodiscoverer.php',
            __DIR__ . '/../src/Discovery.php',
        ])
    ;

    $services->set(SmartFileSystem::class);

    $services->set(FinderSanitizer::class);

    $services->set(SymfonyStyleFactory::class);

    $services->set(SymfonyStyle::class)
        ->factory([ref(SymfonyStyleFactory::class), 'create'])
    ;
};
