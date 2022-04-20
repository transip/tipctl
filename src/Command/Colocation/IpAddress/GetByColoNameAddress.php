<?php

namespace Transip\Api\CLI\Command\Colocation\IpAddress;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByColoNameAddress extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('colocation:ipaddress:getbycolonameaddress')
            ->setDescription('List information for a specific IP address')
            ->addArgument(Field::COLOCATION_NAME, InputArgument::REQUIRED, Field::COLOCATION_NAME__DESC)
            ->addArgument(Field::IPADDRESS, InputArgument::REQUIRED, Field::IPADDRESS__DESC)
            ->setHelp(
                'This API call returns information (generally network information) based on the specific IP address specified.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $coloName      = $input->getArgument(Field::COLOCATION_NAME);
        $coloIpAddress = $input->getArgument(Field::IPADDRESS);

        $ipAddress = $this->getTransipApi()->colocationIpAddress()->getByColoNameAddress($coloName, $coloIpAddress);
        $this->output($ipAddress);
        return 0;
    }
}
