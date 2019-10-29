#!/usr/bin/env php
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Transip\Api\CLI\Command\AvailabilityZone;
use Transip\Api\CLI\Command\Products;
use Transip\Api\CLI\Command\Vps;
use Transip\Api\CLI\Command\Vps\Addon as VpsAddon;
use Transip\Api\CLI\Command\Vps\Backup as VpsBackup;
use Transip\Api\CLI\Command\Vps\IpAddress as VpsIpAddress;
use Transip\Api\CLI\Command\Traffic;

$app = new Application();
$app->setName('Transip API CLI');
$app->add(new AvailabilityZone());
$app->add(new Products());
$app->add(new Vps());
$app->add(new VpsAddon());
$app->add(new VpsBackup());
$app->add(new VpsIpAddress());
$app->add(new Traffic());

$app->run();
