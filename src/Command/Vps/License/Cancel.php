<?php

namespace Transip\Api\CLI\Command\Vps\License;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Cancel extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:license:cancel')
            ->setDescription('Cancel an add-on license based on its id')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::LICENSE_ID, InputArgument::REQUIRED, Field::LICENSE_ID__DESC)
            ->setHelp('Cancel a license based on VpsName and LicenseId. Operating system licenses cannot be cancelled using this command.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName     = $input->getArgument(Field::VPS_NAME);
        $licenseId = $input->getArgument(Field::LICENSE_ID);

        $this->getTransipApi()->vpsLicenses()->cancel($vpsName, $licenseId);
    }
}
