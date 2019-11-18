<?php


namespace Transip\Api\CLI\Command\BigStorage;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Order extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('BigStorage:order')
            ->setDescription('Order a big storage')
            ->addArgument(Field::BIGSTORAGE_SIZE, InputArgument::REQUIRED, Field::BIGSTORAGE_SIZE__DESC)
            ->addArgument(Field::BIGSTORAGE_HASOFFSITEBACKUPS, InputArgument::OPTIONAL, '(optional) Whether to order offsite backups, default is true.')
            ->addArgument(Field::BIGSTORAGE_AVAILABILITYZONE, InputArgument::OPTIONAL, '(optional) The name of the availabilityZone where the BigStorage should be created. This parameter can not be used in conjunction with vpsName. If a vpsName is provided as well as an availabilityZone, the zone of the vps is leading.')
            ->addArgument(Field::VPS_NAME, InputArgument::OPTIONAL, '(optional) The name of the VPS to attach the big storage to.')
            ->setHelp('This command allows you to order a new big storage');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bigStorageSize               = $input->getArgument(Field::BIGSTORAGE_SIZE);

        // Default must be true
        $bigStorageHasOffSiteBackups  = filter_var($input->getArgument(Field::BIGSTORAGE_OFFSITEBACKUPS) ?? true, FILTER_VALIDATE_BOOLEAN);
        $bigStorageAvailabiltyZone    = $input->getArgument(Field::BIGSTORAGE_AVAILABILITYZONE) ?? '';
        $bigStorageVpsName            = $input->getArgument(Field::BIGSTORAGE_VPSNAME) ?? '';

        $this->getTransipApi()->bigStorages()->order($bigStorageSize, $bigStorageHasOffSiteBackups, $bigStorageAvailabiltyZone, $bigStorageVpsName);
    }
}
