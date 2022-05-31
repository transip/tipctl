<?php

namespace Transip\Api\CLI\Command\SslCertificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Install extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('sslcertificate:install')
            ->setDescription('Install an SSL certificate')
            ->setHelp('Install an ssl certificate on a web hosting package')
            ->addArgument(Field::SSL_CERTIFICATE_ID, InputArgument::REQUIRED, Field::SSL_CERTIFICATE_ID__DESC)
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(
                Field::SSL_CERTIFICATE_PASSPHRASE,
                InputArgument::OPTIONAL,
                Field::SSL_CERTIFICATE_PASSPHRASE__DESC
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $certificateId = $input->getArgument(Field::SSL_CERTIFICATE_ID);
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $passphrase = $input->getArgument(Field::SSL_CERTIFICATE_PASSPHRASE);

        $this->getTransipApi()->sslCertificateInstall()->installCertificate($certificateId, $domainName, $passphrase);

        return 0;
    }
}
