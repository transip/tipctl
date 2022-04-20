<?php

namespace Transip\Api\CLI\Command\Vps\License;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Update extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:license:update')
            ->setDescription('Switch between operating system licenses using this command')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::LICENSE_ID, InputArgument::REQUIRED, Field::LICENSE_ID__DESC)
            ->addArgument(Field::NEW_LICENSE_NAME, InputArgument::REQUIRED, Field::NEW_LICENSE_NAME__DESC)
            ->setHelp('Only operating system licenses can be passed through this command.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName        = $input->getArgument(Field::VPS_NAME);
        $licenseId      = $input->getArgument(Field::LICENSE_ID);
        $newLicenseName = $input->getArgument(Field::NEW_LICENSE_NAME);

        $this->getTransipApi()->vpsLicenses()->update(
            $vpsName,
            $licenseId,
            $newLicenseName
        );
        return 0;
    }
}
