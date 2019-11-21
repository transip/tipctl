<?php

namespace Transip\Api\CLI\Command\Vps\OperatingSystem;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Install extends AbstractCommand
{
    private const BASE64INSTALLTEXT = 'Base64InstallText';

    protected function configure(): void
    {
        $this->setName('Vps:OperatingSystem:install')
            ->setDescription('Install an operating system on a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME)
            ->addArgument(Field::VPS_OS_NAME, InputArgument::REQUIRED, Field::VPS_OS_NAME__DESC)
            ->addArgument(Field::VPS_HOSTNAME, InputArgument::OPTIONAL, Field::VPS_HOSTNAME__DESC . Field::OPTIONAL)
            ->addArgument(self::BASE64INSTALLTEXT, InputArgument::OPTIONAL, 'Base64 encoded preseed / kickstart instructions, when installing unattended' . Field::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName             = $input->getArgument(Field::VPS_NAME);
        $operatingSystemName = $input->getArgument(Field::VPS_OS_NAME);
        $hostname            = $input->getArgument(Field::VPS_HOSTNAME) ?? '';
        $base64InstallText   = $input->getArgument(self::BASE64INSTALLTEXT) ?? '';

        $this->getTransipApi()->vpsOperatingSystems()->install(
            $vpsName,
            $operatingSystemName,
            $hostname,
            $base64InstallText
        );
    }
}
