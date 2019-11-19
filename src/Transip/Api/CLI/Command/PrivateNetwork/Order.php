<?php

namespace Transip\Api\CLI\Command\PrivateNetwork;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class Order extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('PrivateNetwork:order')
            ->setDescription("Order a new private network; (\u{26A0} Creates an invoice)")
            ->setHelp('After ordering a private network you’re able to attach it to a VPS to make use of the private network.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getTransipApi()->privateNetworks()->order();
    }
}
