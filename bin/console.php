#!/usr/bin/env php
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Transip\Api\CLI\Command\AvailabilityZones;
use Transip\Api\CLI\Command\BigStorage;
use Transip\Api\CLI\Command\MailService;
use Transip\Api\CLI\Command\Products;
use Transip\Api\CLI\Command\Vps;
use Transip\Api\CLI\Command\Traffic;
use Transip\Api\CLI\Command\PrivateNetwork;

$app = new Application();
$app->setName('Transip API CLI');
$app->add(new AvailabilityZones());
$app->add(new Products());

$app->add(new Vps\GetAll());
$app->add(new Vps\GetByName());
$app->add(new Vps\Order());
$app->add(new Vps\CloneVps());
$app->add(new Vps\SetDescription());
$app->add(new Vps\SetLock());
$app->add(new Vps\Start());
$app->add(new Vps\Stop());
$app->add(new Vps\Reset());
$app->add(new Vps\Cancel());

$app->add(new Vps\Addon());
$app->add(new Vps\Backup());
$app->add(new Vps\IpAddress());
$app->add(new Vps\OperatingSystem());
$app->add(new Vps\Snapshot());
$app->add(new Vps\Upgrade());

$app->add(new PrivateNetwork());
$app->add(new BigStorage());
$app->add(new BigStorage\Backup());

$app->add(new MailService\RegeneratePassword());
$app->add(new MailService\AddDnsEntriesToDomains());
$app->add(new MailService\GetMailServiceInformation());

$app->add(new Traffic());

$app->run();
