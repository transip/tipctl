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
            ->addArgument(self::ARGUMENT_SIZE, InputArgument::REQUIRED, 'The size of the big storage in TB’s, please use a multitude of 2. The maximum size is 40.')
            ->addArgument(self::ARGUMENT_OFFSITEBACKUP, InputArgument::OPTIONAL, '(optional) Whether to order offsite backups, default is false.')
            ->addArgument(self::ARGUMENT_AVAILABILITYZONE, InputArgument::OPTIONAL, '(optional) The name of the availabilityZone where the BigStorage should be created. This parameter can not be used in conjunction with vpsName. If a vpsName is provided as well as an availabilityZone, the zone of the vps is leading.')
            ->addArgument(self::ARGUMENT_VPSNAME, InputArgument::OPTIONAL, '(optional) The name of the VPS to attach the big storage to.')
            ->setHelp('This command allows you to order a new big storage');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $size            = $input->getArgument(self::ARGUMENT_SIZE);
        $offsiteBackups  = filter_var($input->getArgument(self::ARGUMENT_OFFSITEBACKUP) ?? false, FILTER_VALIDATE_BOOLEAN);
        $availabiltyZone = $input->getArgument(self::ARGUMENT_AVAILABILITYZONE) ?? '';
        $vpsName         = $input->getArgument(self::ARGUMENT_VPSNAME) ?? '';

        $this->getTransipApi()->bigStorages()->order($size, $offsiteBackups, $availabiltyZone, $vpsName);
    }
}
