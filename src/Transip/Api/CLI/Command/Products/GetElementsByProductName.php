<?php

namespace Transip\Api\CLI\Command\Products;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetElementsByProductName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('products:getelementsbyproductname')
            ->setDescription('Get all the product elements by ProductName')
            ->addArgument(Field::PRODUCT_NAME, InputArgument::REQUIRED, Field::PRODUCT_NAME__DESC)
            ->setHelp('ProductElements are the specifications of a product');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $productName = $input->getArgument(Field::PRODUCT_NAME);
        $products = $this->getTransipApi()->productElements()->getByProductName($productName);
        $this->output($products);
    }
}
