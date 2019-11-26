<?php

namespace Transip\Api\CLI\Command\Domain\Tld;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:Tld:getAll')
            ->setDescription('Get all available Tlds to register with price')
            ->setHelp('Get all the TLD information like price, min & max character length');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sslCertificates = $this->getTransipApi()->domainTlds()->getAll();
        $this->output($sslCertificates);
    }
}
