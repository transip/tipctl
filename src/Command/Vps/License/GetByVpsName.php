<?php


namespace Transip\Api\CLI\Command\Vps\License;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByVpsName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:license:getbyvpsname')
            ->setDescription('List active, cancellable and available licenses for a VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->setHelp('List active, cancellable and available licenses for a VPS.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $licenses = $this->getTransipApi()->vpsLicenses()->getByVpsName($vpsName);

        $this->output($licenses);
    }
}
