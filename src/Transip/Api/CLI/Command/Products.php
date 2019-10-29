<?php

namespace Transip\Api\CLI\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Transip\Api\Client\Exception\HttpRequest\NotFoundException;

class Products extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Products')
            ->setDescription('TransIP Products')
            ->setHelp('All orderable products via the API excluding domains')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getAll");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "getAll":
                $products = $this->getTransipApi()->products()->getAll();
                $output->writeln(print_r($products, 1));
                break;
            default:
                throw new \Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
