<?php

namespace Transip\Api\CLI\Command\SslCertificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetSelection extends AbstractCommand
{
    public function configure()
    {
        $this
            ->setName('sslcertificate:getselection')
            ->setDescription('Get SSL certificates for selection')
            ->setHelp('Get SSl certificates for page number and amount of certificates per page')
            ->addArgument(Field::SSL_CERTIFICATE_PAGE, InputArgument::REQUIRED, Field::SSL_CERTIFICATE_PAGE__DESC)
            ->addArgument(Field::SSL_CERTIFICATE_ITEMS_PER_PAGE, InputArgument::REQUIRED, Field::SSL_CERTIFICATE_ITEMS_PER_PAGE__DESC);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $page = (int) $input->getArgument(Field::SSL_CERTIFICATE_PAGE);
        $itemsPerPage = (int) $input->getArgument(Field::SSL_CERTIFICATE_ITEMS_PER_PAGE);

        $certificates = $this->getTransipApi()->sslCertificate()->getSelection($page, $itemsPerPage);

        $this->output($certificates);
    }
}
