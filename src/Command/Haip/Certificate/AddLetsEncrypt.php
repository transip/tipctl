<?php

namespace Transip\Api\CLI\Command\Haip\Certificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class AddLetsEncrypt extends AbstractCommand
{
    private const COMMON_NAME = 'commonName';

    protected function configure()
    {
        $this->setName('haip:certificate:addletsencrypt')
            ->setDescription('Request a lets encrypt certificate by a common name and add it to your HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(Field::SSL_COMMON_NAME, InputArgument::REQUIRED, Field::SSL_COMMON_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName   = $input->getArgument(Field::HAIP_NAME);
        $commonName = $input->getArgument(self::COMMON_NAME);

        $this->getTransipApi()->haipCertificates()->addByCommonName($haipName, $commonName);
    }
}
