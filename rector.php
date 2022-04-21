<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Rector\Set\ValueObject\LevelSetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(LevelSetList::UP_TO_PHP_72);

    // register single rule
    $services = $containerConfigurator->services();
    $services->set(NoUnusedImportsFixer::class);

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::AUTO_IMPORT_NAMES, true)
        ->set(Option::PARALLEL, true)
        ->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_72)
        ->set(Option::PATHS, [__DIR__])
        ->set(Option::SKIP, [
        __DIR__ . '/vendor',
    ]);

    $runsInGitlabCi = \getenv('GITLAB_CI');
    if ($runsInGitlabCi !== \false) {
        $parameters->set(Option::CACHE_DIR, __DIR__ . '/.rector/cache');
    }
};
