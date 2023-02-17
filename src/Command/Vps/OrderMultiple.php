<?php

namespace Transip\Api\CLI\Command\Vps;

use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderMultiple extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:ordermultiple')
            ->setDescription('Order multiple new VPSs')
            ->addArgument(Field::VPS_MULTIPLE_COUNT, InputArgument::REQUIRED, Field::VPS_MULTIPLE_COUNT__DESC)
            ->addArgument(Field::PRODUCT_NAME, InputArgument::REQUIRED, Field::PRODUCT_NAME__DESC)
            ->addArgument(Field::VPS_OS_NAME, InputArgument::REQUIRED, Field::VPS_OS_NAME__DESC)
            ->addArgument(Field::AVAILABILITY_ZONE, InputArgument::OPTIONAL, Field::AVAILABILITY_ZONE__DESC . Field::OPTIONAL, '')
            ->addArgument(Field::VPS_ADDONS, InputArgument::OPTIONAL, Field::VPS_ADDONS__DESC . Field::OPTIONAL, '')
            ->addArgument(Field::VPS_INSTALL_FLAVOUR, InputArgument::OPTIONAL, Field::VPS_INSTALL_FLAVOUR__DESC)
            ->addArgument(Field::VPS_USERNAME, InputArgument::OPTIONAL, Field::VPS_USERNAME__DESC . Field::OPTIONAL, '')
            ->addArgument(Field::VPS_HOSTNAME, InputArgument::OPTIONAL, Field::VPS_HOSTNAME__DESC . Field::OPTIONAL, '')
            ->addArgument(Field::VPS_DESCRIPTION, InputArgument::OPTIONAL, Field::VPS_DESCRIPTION__DESC . Field::OPTIONAL, '')
            ->addArgument(Field::VPS_SSH_KEYS, InputArgument::OPTIONAL, Field::VPS_SSH_KEYS__DESC . Field::OPTIONAL, '')
            ->addArgument(Field::VPS_BASE64INSTALLTEXT, InputArgument::OPTIONAL, Field::VPS_BASE64INSTALLTEXT__DESC . Field::OPTIONAL, '')
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC)
            ->setHelp('Order multiple VPSs with this command. After the order process has been completed (payment will occur at a later stage should direct debit be used) the VPS will automatically be provisioned and deployed. Use Products:getAll to get a list of products');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $count             = $input->getArgument(Field::VPS_MULTIPLE_COUNT);
        $productName       = $input->getArgument(Field::PRODUCT_NAME);
        $operatingSystem   = $input->getArgument(Field::VPS_OS_NAME);
        $addons            = $input->getArgument(Field::VPS_ADDONS);
        $hostname          = $input->getArgument(Field::VPS_HOSTNAME);
        $availabilityZone  = $input->getArgument(Field::AVAILABILITY_ZONE);
        $description       = $input->getArgument(Field::VPS_DESCRIPTION);
        $installFlavour    = $input->getArgument(Field::VPS_INSTALL_FLAVOUR);
        $username          = $input->getArgument(Field::VPS_USERNAME);
        $sshKeys           = $input->getArgument(Field::VPS_SSH_KEYS);
        $base64InstallText = $input->getArgument(Field::VPS_BASE64INSTALLTEXT);
        $waitForAction     = $input->getOption(Field::ACTION_WAIT);

        $addons  = (strlen($addons) > 1) ? explode(',', $addons) : [];
        $sshKeys = (strlen($sshKeys) > 1) ? explode(',', $sshKeys) : [];

        $vpss = [];

        for ($i = 0; $i < $count; $i++) {
            $vpss[] = [
                "productName"       => $productName,
                "operatingSystem"   => $operatingSystem,
                "addons"            => $addons,
                "hostname"          => $hostname,
                "availabilityZone"  => $availabilityZone,
                "description"       => $description,
                "installFlavour"    => $installFlavour,
                "username"          => $username,
                "sshKeys"           => $sshKeys,
                "base64InstallText" => $base64InstallText,
            ];
        }

        $response = $this->getTransipApi()->vps()->orderMultiple($vpss);
        $action = $this->getTransipApi()->actions()->parseActionFromResponse($response);
        
        if ($action && $waitForAction) {
            $app = $this->getApplication();

            if (!$app) {
                return 0;
            }

            $command = $app->get('action:pollstatus');
                
            $arguments = [
                'actionUuid'        => $action->getUuid()
            ];

            $actionInput = new ArrayInput($arguments);
            $command->run($actionInput, $output);
        }
        return 0;
    }
}
