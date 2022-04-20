<?php

namespace Transip\Api\CLI\Command\SslCertificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Details extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('sslcertificate:details')
            ->setDescription('Get SSL certificate details')
            ->setHelp('Get all details for a SSL certificate')
            ->addArgument(Field::SSL_CERTIFICATE_ID, InputArgument::REQUIRED, Field::SSL_CERTIFICATE_ID__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $certificateId = $input->getArgument(Field::SSL_CERTIFICATE_ID);
        $details = $this->getTransipApi()->sslCertificateDetails()->getBySslCertificateId($certificateId);
        $this->output($details);
        return 0;
    }
}
