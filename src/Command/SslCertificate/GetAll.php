<?php

namespace Transip\Api\CLI\Command\SslCertificate;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetAll extends AbstractCommand
{
    public function configure()
    {
        $this
            ->setName('sslcertificate:getall')
            ->setDescription('Get all SSL certificates')
            ->setHelp('Get all SSL certificates in your account');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $certificates = $this->getTransipApi()->sslCertificate()->getAll();

        $this->output($certificates);
    }
}
