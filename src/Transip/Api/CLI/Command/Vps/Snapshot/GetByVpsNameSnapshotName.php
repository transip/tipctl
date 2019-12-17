<?php

namespace Transip\Api\CLI\Command\Vps\Snapshot;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByVpsNameSnapshotName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:snapshot:getByVpsNameSnapshotName')
            ->setDescription('List the details of a specific vps snapshot')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_SNAPSHOT_NAME, InputArgument::REQUIRED, Field::VPS_SNAPSHOT_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $snapshotName = $input->getArgument(Field::VPS_SNAPSHOT_NAME);

        $snapshot = $this->getTransipApi()->vpsSnapshots()->getByVpsNameSnapshotName($vpsName, $snapshotName);
        $this->output($snapshot);
    }
}
