<?php

namespace Transip\Api\CLI\Command\Haip\Certificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class AddExisting extends AbstractCommand
{

    private const SSL_CERTIFICATE_ID = 'sslCertificateId';

    protected function configure()
    {
        $this->setName('Haip:Certificate:addExisting')
            ->setDescription('Add existing Domain:Ssl certificates to your HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(self::SSL_CERTIFICATE_ID, InputArgument::REQUIRED, 'Provide the identifier of an existing Domain:Ssl certificate');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);
        $certificateId = $input->getArgument(self::SSL_CERTIFICATE_ID);

        $this->getTransipApi()->haipCertificates()->addBySslCertificateId($haipName, intval($certificateId));
    }
}