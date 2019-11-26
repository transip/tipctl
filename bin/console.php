#!/usr/bin/env php
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Finder\Finder;
use Transip\Api\CLI\Utilities\Strings;

$app = new Application();
$app->setName('Transip API CLI');

$finder = new Finder();
$finder->files()->in(__DIR__ . '/../src/Transip/Api/CLI/Command');

$ignoreClass = ['Field', 'AbstractCommand'];

foreach ($finder as $file) {
    $className = str_replace('.php', '', $file->getRelativePathname());
    $className = str_replace('/', '\\', $className);

    $class = explode('/', $className);
    if (in_array(end($class), $ignoreClass, true)) {
        continue;
    }

    $fullClassName = "Transip\Api\CLI\Command\\" . $className;

    $app->add(new $fullClassName);
}

$app->run();
