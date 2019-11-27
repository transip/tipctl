<?php


namespace Transip\Api\CLI\Command\Vps\Backup;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByVpsName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('Vps:Backup:getByVpsName')
            ->setDescription('List backups for a vps')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->setHelp('TransIP offers multiple back-up types, every VPS has 4 hourly back-ups by default, weekly back-ups are available for a small fee. This API call returns back-ups for both types.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);

        $vps = $this->getTransipApi()->vpsBackups()->getByVpsName($vpsName);
        $this->output($vps);
    }
}
