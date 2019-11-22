<?php

namespace Transip\Api\CLI\Command\Products;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetAll extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Products:getAll')
            ->setDescription('Get all orderable products via the API excluding domains')
            ->setHelp('All orderable products via the API excluding domains');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $products = $this->getTransipApi()->products()->getAll();
        $this->output($products, $input->getOption(Field::FORMAT));
    }
}
