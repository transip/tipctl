<?php


namespace Transip\Api\CLI\Command\Vps\Backup;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class ConvertToSnapshot extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:backup:convertToSnapshot')
            ->setDescription('Convert a backup to a snapshot.')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_BACKUP_ID, InputArgument::REQUIRED, Field::VPS_BACKUP_ID__DESC)
            ->addArgument(Field::VPS_SNAPSHOT_DESCRIPTION, InputArgument::OPTIONAL, Field::VPS_SNAPSHOT_DESCRIPTION__DESC . Field::OPTIONAL)
            ->setHelp('Convert a backup to a snapshot for the VPS. Setting a description for a snapshot is highly recommended in case you have multiple snapshots for one VPS.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $backupId = $input->getArgument(Field::VPS_BACKUP_ID);
        $snapshotDescription = $input->getArgument(Field::VPS_SNAPSHOT_DESCRIPTION);

        if (!$snapshotDescription) {
            $snapshotDescription = '';
        }

        $this->getTransipApi()->vpsBackups()->convertBackupToSnapshot($vpsName, $backupId, $snapshotDescription);
    }
}
