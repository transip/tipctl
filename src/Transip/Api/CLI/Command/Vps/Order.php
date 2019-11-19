<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Order extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Vps:order')
            ->setDescription('Order a new Vps')
            ->setHelp('Order a Vps with the following arguments: productName, operatingSystem is required. addons(comma separated), hostname, availabilityZone optional')
            ->addArgument('args', InputArgument::IS_ARRAY, 'Optional arguments');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arguments = $input->getArgument('args');
        if (count($arguments) < 2) {
            throw new \Exception('productName, operatingSystem is required. addons(comma separated), hostname, availabilityZone optional');
        }

        $productName      = $arguments[0];
        $operatingSystem  = $arguments[1];
        $addons           = $arguments[2] ?? '';
        $hostname         = $arguments[3] ?? '';
        $availabilityZone = $arguments[4] ?? '';

        if ($addons != '') {
            $addons = explode(',', $addons);
        } else {
            $addons = [];
        }

        $this->getTransipApi()->vps()->order(
            $productName,
            $operatingSystem,
            $addons,
            $hostname,
            $availabilityZone
        );
    }
}
