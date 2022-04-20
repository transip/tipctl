<?php

namespace Transip\Api\CLI\Command\Products;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('products:getall')
            ->setDescription('Get all orderable products via the API excluding domains')
            ->setHelp('All orderable products via the API excluding domains');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $products = $this->getTransipApi()->products()->getAll();
        $this->output($products);
        return 0;
    }
}
