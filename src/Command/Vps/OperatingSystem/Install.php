<?php

namespace Transip\Api\CLI\Command\Vps\OperatingSystem;

use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Install extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:operatingsystem:install')
            ->setDescription('Install an operating system on a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME)
            ->addArgument(Field::VPS_OS_NAME, InputArgument::REQUIRED, Field::VPS_OS_NAME__DESC)
            ->addArgument(Field::VPS_INSTALL_FLAVOUR, InputArgument::OPTIONAL, Field::VPS_INSTALL_FLAVOUR__DESC . Field::OPTIONAL)
            ->addArgument(Field::VPS_HOSTNAME, InputArgument::OPTIONAL, Field::VPS_HOSTNAME__DESC . Field::OPTIONAL)
            ->addArgument(Field::VPS_USERNAME, InputArgument::OPTIONAL, Field::VPS_USERNAME__DESC . Field::OPTIONAL)
            ->addArgument(Field::VPS_SSH_KEYS, InputArgument::OPTIONAL, Field::VPS_SSH_KEYS__DESC . Field::OPTIONAL)
            ->addArgument(Field::VPS_BASE64INSTALLTEXT, InputArgument::OPTIONAL, Field::VPS_BASE64INSTALLTEXT__DESC . Field::OPTIONAL)
            ->addArgument(Field::LICENSE_NAMES, InputArgument::OPTIONAL, Field::LICENSE_NAMES__DESC . Field::OPTIONAL, '')
            ->addOption(Field::ACTION_WAIT, 'w', InputOption::VALUE_NONE, Field::ACTION_WAIT_DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName             = $input->getArgument(Field::VPS_NAME);
        $operatingSystemName = $input->getArgument(Field::VPS_OS_NAME);
        $installFlavour      = $input->getArgument(Field::VPS_INSTALL_FLAVOUR) ?? '';
        $hostname            = $input->getArgument(Field::VPS_HOSTNAME) ?? '';
        $username            = $input->getArgument(Field::VPS_USERNAME) ?? '';
        $sshKeys             = $input->getArgument(Field::VPS_SSH_KEYS);
        $base64InstallText   = $input->getArgument(Field::VPS_BASE64INSTALLTEXT) ?? '';
        $licenseNames        = $input->getArgument(Field::LICENSE_NAMES);
        $waitForAction       = $input->getOption(Field::ACTION_WAIT);

        $sshKeys = (strlen($sshKeys) > 1) ? explode(',', $sshKeys) : [];
        $licenseNames = (strlen($licenseNames) > 1) ? explode(',', $licenseNames) : [];

        $response = $this->getTransipApi()->vpsOperatingSystems()->install(
            $vpsName,
            $operatingSystemName,
            $hostname,
            $base64InstallText,
            $installFlavour,
            $username,
            $sshKeys,
            $licenseNames
        );
        
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
