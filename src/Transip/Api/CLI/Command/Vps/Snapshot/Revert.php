<?php

namespace Transip\Api\CLI\Command\Vps\Snapshot;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Revert extends AbstractCommand
{
    private const DESTINATION_VPS_NAME = 'DestinationVpsName';

    protected function configure()
    {
        $this->setName('Vps:Snapshot:Revert')
            ->setDescription('Revert a snapshot to a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_SNAPSHOT_NAME, InputArgument::REQUIRED, Field::VPS_SNAPSHOT_NAME__DESC)
            ->addArgument(self::DESTINATION_VPS_NAME, InputArgument::OPTIONAL, 'VpsName. When set, reverts the snapshot to this VPS.' . Field::OPTIONAL)
            ->setHelp('When restoring a snapshot, this can be done either on the VPS the snapshot originates from or onto another VPS. Specifying the DestinationVpsName makes sure the snapshot is restored onto another VPS');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $snapshotName = $input->getArgument(Field::VPS_SNAPSHOT_NAME);
        $destinationVpsName = $input->getArgument(self::DESTINATION_VPS_NAME) ?? '';

        $this->getTransipApi()->vpsSnapshots()->revertSnapshot($vpsName, $snapshotName, $destinationVpsName);
    }
}
