<?php


namespace Transip\Api\CLI\Command\BigStorage;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Order extends AbstractCommand
{
    const BIGSTORAGE_SIZE = 'size';
    const BIGSTORAGE_OFFSITEBACKUPS = 'offSiteBackups';
    const BIGSTORAGE_AVAILABILITYZONE = 'availabilityZone';
    const BIGSTORAGE_VPSNAME = 'vpsName';

    protected function configure()
    {
        $this->setName('BigStorage:order')
            ->setDescription('Order a big storage')
            ->addArgument(self::BIGSTORAGE_SIZE, InputArgument::REQUIRED, 'The size of the big storage in TB’s, please use a multitude of 2. The maximum size is 40.')
            ->addArgument(self::BIGSTORAGE_OFFSITEBACKUPS, InputArgument::OPTIONAL, '(optional) Whether to order offsite backups, default is true.')
            ->addArgument(self::BIGSTORAGE_AVAILABILITYZONE, InputArgument::OPTIONAL, '(optional) The name of the availabilityZone where the BigStorage should be created. This parameter can not be used in conjunction with vpsName. If a vpsName is provided as well as an availabilityZone, the zone of the vps is leading.')
            ->addArgument(self::BIGSTORAGE_VPSNAME, InputArgument::OPTIONAL, '(optional) The name of the VPS to attach the big storage to.')
            ->setHelp('This command allows you to order a new big storage');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageSize               = $input->getArgument(self::BIGSTORAGE_SIZE);
        $bigStorageHasOffSiteBackups  = filter_var($input->getArgument(self::BIGSTORAGE_OFFSITEBACKUPS) ?? true, FILTER_VALIDATE_BOOLEAN);
        $bigStorageAvailabiltyZone    = $input->getArgument(self::BIGSTORAGE_AVAILABILITYZONE) ?? '';
        $bigStorageVpsName            = $input->getArgument(self::BIGSTORAGE_VPSNAME) ?? '';

        $this->getTransipApi()->bigStorages()->order($bigStorageSize, $bigStorageHasOffSiteBackups, $bigStorageAvailabiltyZone, $bigStorageVpsName);
    }
}
