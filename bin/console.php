#!/usr/bin/env php
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Finder\Finder;

$app = new Application();
$app->setName('Transip API CLI');

$finder = new Finder();
$finder->files()->in(__DIR__ . '/../src/Transip/Api/CLI/Command');

foreach ($finder as $file) {
    $className = str_replace('.php', '', $file->getRelativePathname());
    $className = str_replace('/', '\\', $className);

    $fullClassName = "Transip\Api\CLI\Command\\" . $className;

    if(!strpos_arr($fullClassName, ['Abstract', 'Field'])) {
        $app->add(new $fullClassName);
    }
}

$app->run();

function strpos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = strpos($haystack, $what))!==false) return $pos;
    }
    return false;
}
