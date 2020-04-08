#!/usr/bin/env php
<?php

use Transip\Api\CLI\Settings\Settings;

require_once(__DIR__ . '/../vendor/autoload.php');

if (!isset($argv[1])) {
    throw new RuntimeException("An argument must be provided, usage example: php {$argv[0]} v6.1.3");
}

$newVersion = ltrim($argv[1], 'v');

if (Settings::TRANSIP_CLI_VERSION !== $newVersion) {
    throw new RuntimeException("Version in Settings class must be updated to: {$newVersion}");
}
