<?php

namespace Transip\Api\CLI\Command\Haip\Certificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Remove extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('haip:certificate:remove')
            ->setDescription('Remove a certificate from your HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(Field::SSL_CERTIFICATE_ID, InputArgument::REQUIRED, Field::SSL_CERTIFICATE_ID__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName      = $input->getArgument(Field::HAIP_NAME);
        $certificateId = $input->getArgument(Field::SSL_CERTIFICATE_ID);

        $this->getTransipApi()->haipCertificates()->delete($haipName, $certificateId);
    }
}
