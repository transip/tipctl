<?php


namespace Transip\Api\CLI\Command\AvailabilityZones;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Exception;

class GetByVpsName extends AbstractCommand
{
    const TRAFFIC_VPSNAME = 'vpsName';

    protected function configure()
    {
        $this->setName('Traffic:getByVpsName')
            ->setDescription('Get traffic information for a VPS')
            ->addArgument(self::TRAFFIC_VPSNAME, InputArgument::REQUIRED, 'The name of the vps')
            ->setHelp('This command prints traffic information for a given vps.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(self::TRAFFIC_VPSNAME);
        if (strlen($vpsName) < 3) {
            throw new Exception('Vps name is required');
        }

        $traffic = $this->getTransipApi()->traffic()->getByVpsName($vpsName);
        $output->writeln(print_r($traffic,1));
    }


}
