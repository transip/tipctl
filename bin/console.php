#!/usr/bin/env php
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Finder\Finder;

$app = new Application();
$app->setName('Transip API CLI');

$finder = new Finder();
$finder->files()->in(__DIR__ . '/../src/Transip/Api/CLI/Command');

foreach ($finder as $file) {
    $className = str_replace('.php', '', $file->getRelativePathname());
    $className = str_replace('/', '\\', $className);

    $fullClassName = "Transip\Api\CLI\Command\\" . $className;

    $reflectionClass = new ReflectionClass($fullClassName);
    if ($reflectionClass->isInstantiable() && $reflectionClass->isSubclassOf(Command::class)) {
        $app->add(new $fullClassName);
    }
}

$app->run();
