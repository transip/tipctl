<?php

namespace Transip\Api\CLI\Command\Colocation\IpAddress;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByColoName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('colocation:ipaddress:getbycoloname')
            ->setDescription('List IP addresses for Colocation')
            ->addArgument(Field::COLOCATION_NAME, InputArgument::REQUIRED, Field::COLOCATION_NAME__DESC)
            ->setHelp('This API call will return all IPv4 and IPv6 addresses attached to the Colocation');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $coloName = $input->getArgument(Field::COLOCATION_NAME);
        $ipAddresses = $this->getTransipApi()->colocationIpAddress()->getByColoName($coloName);

        $this->output($ipAddresses);
        return 0;
    }
}
