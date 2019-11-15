<?php


namespace Transip\Api\CLI\Command\BigStorage;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Order extends AbstractCommand
{
    const ARGUMENT_SIZE = 'Size';
    const ARGUMENT_OFFSITEBACKUP = 'OffsiteBackups';
    const ARGUMENT_AVAILABILITYZONE = 'AvailabilityZone';
    const ARGUMENT_VPSNAME = 'VpsName';

    protected function configure()
    {
        $this->setName('BigStorage:order')
            ->setDescription('Order a big storage')
            ->addArgument(self::ARGUMENT_SIZE, InputArgument::REQUIRED, 'You must provide a big storage size')
            ->addArgument(self::ARGUMENT_OFFSITEBACKUP, InputArgument::OPTIONAL, 'Boolean true/false if you want OffsiteBackups (true by default)')
            ->addArgument(self::ARGUMENT_AVAILABILITYZONE, InputArgument::OPTIONAL, '???')
            ->addArgument(self::ARGUMENT_VPSNAME, InputArgument::OPTIONAL, 'Vps name that the big storage will mount to????')
            ->setHelp('This command allows you to order a new big storage');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $size            = $input->getArgument(self::ARGUMENT_SIZE);
        $offsiteBackups  = filter_var($input->getArgument(self::ARGUMENT_OFFSITEBACKUP) ?? true, FILTER_VALIDATE_BOOLEAN);
        $availabiltyZone = $input->getArgument(self::ARGUMENT_AVAILABILITYZONE) ?? '';
        $vpsName         = $input->getArgument(self::ARGUMENT_VPSNAME) ?? '';

        $this->getTransipApi()->bigStorages()->order($size, $offsiteBackups, $availabiltyZone, $vpsName);
    }
}
