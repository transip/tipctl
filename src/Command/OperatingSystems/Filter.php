<?php

namespace Transip\Api\CLI\Command\OperatingSystems;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Filter extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('operatingsystems:filter')
            ->setDescription('Gather an accurate list of operating systems filtered by product and addons')
            ->addArgument(Field::PRODUCT_NAME, InputArgument::REQUIRED, Field::PRODUCT_NAME__DESC)
            ->addArgument(Field::OPERATING_SYSTEM_FILTER_ADDONS, InputArgument::OPTIONAL | InputArgument::IS_ARRAY, Field::OPERATING_SYSTEM_FILTER_ADDONS__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $product = $input->getArgument(Field::PRODUCT_NAME);
        $addons = $input->getArgument(Field::OPERATING_SYSTEM_FILTER_ADDONS) ?? [];

        $operatingSystemFilter = $this->getTransipApi()->operatingSystemFilter()->getAll($product, $addons);

        $this->output($operatingSystemFilter);
        return 0;
    }
}
