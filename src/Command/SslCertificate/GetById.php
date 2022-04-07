<?php

namespace Transip\Api\CLI\Command\SslCertificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetById extends AbstractCommand
{
    public function configure()
    {
        $this
            ->setName('sslcertificate:getbyid')
            ->setDescription('Get SSL certificate')
            ->setHelp('Get SSl certificate by id')
            ->addArgument(Field::SSL_CERTIFICATE_ID, InputArgument::REQUIRED, Field::SSL_CERTIFICATE_ID__DESC);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $certificateId = (int) $input->getArgument(Field::SSL_CERTIFICATE_ID);
        $certificate = $this->getTransipApi()->sslCertificate()->getById($certificateId);
        $this->output($certificate);
    }
}
