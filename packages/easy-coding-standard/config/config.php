<?php declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Nette\Utils\Strings;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/services.php');

    $containerConfigurator->import(__DIR__ . '/parameters/parameter_name_guard.php');

    $containerConfigurator->import(__DIR__ . '/../packages/*/config/*.php');

    $parameters = $containerConfigurator->parameters();

    $parameters->set('indentation', 'spaces');

    $parameters->set('line_ending', PHP_EOL);

    $parameters->set('cache_directory', sys_get_temp_dir() . '/_changed_files_detector%env(TEST_SUFFIX)%');

    $parameters->set('cache_namespace', Strings::webalize(getcwd()));

    $parameters->set('skip', []);

    $parameters->set('only', []);

    $parameters->set('paths', []);

    $parameters->set('sets', []);

    $parameters->set('file_extensions', ['php']);

    $parameters->set('exclude_files', []);

    $parameters->set('env(TEST_SUFFIX)', '');
};
