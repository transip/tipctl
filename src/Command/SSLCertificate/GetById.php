<?php

namespace Transip\Api\CLI\Command\SSLCertificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetById extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('sslcertificate:getbyid')
            ->setDescription('Request information about an existing SSL certificate')
            ->addArgument(Field::SSL_CERTIFICATE_ID, InputArgument::REQUIRED, Field::SSL_CERTIFICATE_ID__DESC)
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sslCertificateId = $input->getArgument(Field::SSL_CERTIFICATE_ID);

        $sslCertificate = $this->getTransipApi()->sslCertificate()->getById($sslCertificateId);

        $this->output($sslCertificate);
    }
}
