<?php

namespace Transip\Api\CLI\Command\Vps\Snapshot;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Revert extends AbstractCommand
{

    protected function configure(): void
    {
        $this->setName('vps:snapshot:revert')
            ->setDescription('Revert a snapshot to a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_SNAPSHOT_NAME, InputArgument::REQUIRED, Field::VPS_SNAPSHOT_NAME__DESC)
            ->addArgument(Field::VPS_DESTINATION_VPS_NAME, InputArgument::OPTIONAL, Field::VPS_DESTINATION_VPS_NAME__DESC . Field::OPTIONAL)
            ->setHelp('When restoring a snapshot, this can be done either on the VPS the snapshot originates from or onto another VPS. Specifying the DestinationVpsName makes sure the snapshot is restored onto another VPS');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $snapshotName = $input->getArgument(Field::VPS_SNAPSHOT_NAME);
        $destinationVpsName = $input->getArgument(Field::VPS_DESTINATION_VPS_NAME) ?? '';

        $this->getTransipApi()->vpsSnapshots()->revertSnapshot($vpsName, $snapshotName, $destinationVpsName);
    }
}
