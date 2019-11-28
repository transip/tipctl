<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Order extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('Vps:order')
            ->setDescription('Order a new VPS')
            ->setHelp('Order a Vps with this command. After the order process has been completed (payment will occur at a later stage should direct debit be used) the VPS will automatically be provisioned and deployed. Use Products:getAll to get a list of products')
            ->addArgument(Field::VPS_PRODUCT_NAME, InputArgument::REQUIRED, Field::VPS_PRODUCT_NAME__DESC)
            ->addArgument(Field::VPS_OS_NAME, InputArgument::REQUIRED, Field::VPS_OS_NAME__DESC)
            ->addArgument(Field::VPS_ADDONS, InputArgument::OPTIONAL, Field::VPS_ADDONS__DESC . Field::OPTIONAL)
            ->addArgument(Field::VPS_HOSTNAME, InputArgument::OPTIONAL, Field::VPS_HOSTNAME__DESC . Field::OPTIONAL)
            ->addArgument(Field::AVAILABILITY_ZONE, InputArgument::OPTIONAL, Field::AVAILABILITY_ZONE . Field::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $productName      = $input->getArgument(Field::VPS_PRODUCT_NAME);
        $operatingSystem  = $input->getArgument(Field::VPS_OS_NAME);
        $addons           = $input->getArgument(Field::VPS_ADDONS) ?? '';
        $hostname         = $input->getArgument(Field::VPS_HOSTNAME) ?? '';
        $availabilityZone = $input->getArgument(Field::AVAILABILITY_ZONE) ?? '';

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
