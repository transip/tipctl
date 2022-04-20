<?php

namespace Transip\Api\CLI\Command\Vps\Snapshot;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Delete extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:snapshot:delete')
            ->setDescription('Delete a snapshot')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_SNAPSHOT_NAME, InputArgument::REQUIRED, Field::VPS_SNAPSHOT_NAME__DESC)
            ->setHelp('Delete a VPS snapshot using this command.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $snapshotName = $input->getArgument(Field::VPS_SNAPSHOT_NAME);

        $this->getTransipApi()->vpsSnapshots()->deleteSnapshot($vpsName, $snapshotName);
        return 0;
    }
}
