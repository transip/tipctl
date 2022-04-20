<?php

namespace Transip\Api\CLI\Command\Vps\Backup;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Revert extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:backup:revert')
            ->setDescription('Revert a VPS back-up and restore the VPS to an earlier state')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_BACKUP_ID, InputArgument::REQUIRED, Field::VPS_BACKUP_ID__DESC)
            ->setHelp('Reverting a VPS back-up will restore the VPS to an earlier state. Use this API call with care, as data created after the back-up creation date can be wiped when a back-up is restored.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $backupId = $input->getArgument(Field::VPS_BACKUP_ID);

        $this->getTransipApi()->vpsBackups()->revertBackup($vpsName, $backupId);
        return 0;
    }
}
