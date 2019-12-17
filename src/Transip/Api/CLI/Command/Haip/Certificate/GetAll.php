<?php

namespace Transip\Api\CLI\Command\Haip\Certificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetAll extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('haip:certificate:getAll')
            ->setDescription('List all SSL Certificates that are currently used by your HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);

        $certificates = $this->getTransipApi()->haipCertificates()->getByHaipName($haipName);

        $this->output($certificates);
    }
}
