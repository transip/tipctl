<?php

namespace Transip\Api\CLI\Command\SslCertificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetById extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('sslcertificate:getbyid')
            ->setDescription('Get SSL certificate')
            ->setHelp('Get SSl certificate by id')
            ->addArgument(Field::SSL_CERTIFICATE_ID, InputArgument::REQUIRED, Field::SSL_CERTIFICATE_ID__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $certificateId = $input->getArgument(Field::SSL_CERTIFICATE_ID);
        $certificate = $this->getTransipApi()->sslCertificate()->getById($certificateId);
        $this->output($certificate);
        return 0;
    }
}
