<?php

namespace Transip\Api\CLI\Command\Haip\Certificate;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Remove extends AbstractCommand
{
    private const CERTIFICATE_ID = 'certificateId';

    protected function configure()
    {
        $this->setName('Haip:Certificate:remove')
            ->setDescription('Remove a certificate from your HA-IP')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(self::CERTIFICATE_ID, InputArgument::REQUIRED, 'The id of the HA-IP certificate to remove');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);
        $certificateId = $input->getArgument(self::CERTIFICATE_ID);

        $this->getTransipApi()->haipCertificates()->delete($haipName, $certificateId);
    }
}
