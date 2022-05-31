<?php

namespace Transip\Api\CLI\Command\SslCertificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Uninstall extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('sslcertificate:uninstall')
            ->setDescription('Uninstall an SSL certificate')
            ->setHelp('Uninstall an ssl certificate on from web hosting package')
            ->addArgument(Field::SSL_CERTIFICATE_ID, InputArgument::REQUIRED, Field::SSL_CERTIFICATE_ID__DESC)
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $certificateId = $input->getArgument(Field::SSL_CERTIFICATE_ID);
        $domainName = $input->getArgument(Field::DOMAIN_NAME);

        $this->getTransipApi()->sslCertificateUninstall()->uninstallCertificate($certificateId, $domainName);

        return 0;
    }
}
