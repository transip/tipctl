<?php

namespace Transip\Api\CLI\Command\Vps\Snapshot;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Create extends AbstractCommand
{
    private const VPS_SNAPSHOT_DESCRIPTION = 'SnapshotDescription';

    protected function configure(): void
    {
        $this->setName('Vps:Snapshot:Create')
            ->setDescription('Create a snapshot for a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(self::VPS_SNAPSHOT_DESCRIPTION, InputArgument::REQUIRED, 'The snapshot description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $snapshotDescription = $input->getArgument(self::VPS_SNAPSHOT_DESCRIPTION);

        $this->getTransipApi()->vpsSnapshots()->createSnapshot($vpsName, $snapshotDescription);
    }
}
