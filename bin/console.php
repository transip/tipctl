#!/usr/bin/env php
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Transip\Api\CLI\Command\AvailabilityZones;
use Transip\Api\CLI\Command\BigStorage;
use Transip\Api\CLI\Command\BigStorage\Backup as BigStorageBackup;
use Transip\Api\CLI\Command\MailService;
use Transip\Api\CLI\Command\Products;
use Transip\Api\CLI\Command\Vps;
use Transip\Api\CLI\Command\Vps\Addon as VpsAddon;
use Transip\Api\CLI\Command\Vps\Backup as VpsBackup;
use Transip\Api\CLI\Command\Vps\IpAddress as VpsIpAddress;
use Transip\Api\CLI\Command\Vps\OperatingSystem as VpsOperatingSystem;
use Transip\Api\CLI\Command\Vps\Snapshot as VpsSnapshot;
use Transip\Api\CLI\Command\Vps\Upgrade as VpsUpgrade;
use Transip\Api\CLI\Command\Traffic;
use Transip\Api\CLI\Command\PrivateNetwork;

$app = new Application();
$app->setName('Transip API CLI');
$app->add(new AvailabilityZones());
$app->add(new Products());
$app->add(new Vps());
$app->add(new VpsAddon());
$app->add(new VpsBackup());
$app->add(new VpsIpAddress());
$app->add(new VpsOperatingSystem());
$app->add(new VpsSnapshot());
$app->add(new VpsUpgrade());
$app->add(new PrivateNetwork());
$app->add(new BigStorage());
$app->add(new BigStorageBackup());
$app->add(new MailService());
$app->add(new Traffic());

$app->run();
