<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Haip;

class SetTlsMode extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:settlsmode')
            ->setDescription('Set TLS mode to: `' . Haip::TLSMODE_TLS10_11_12 . '`, `'. Haip::TLSMODE_TLS11_12 . '` or `' . Haip::TLSMODE_TLS12 . '`')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(Field::HAIP_TLS_MODE, InputArgument::REQUIRED, Field::HAIP_TLS_MODE__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);
        $tlsMode = $input->getArgument(Field::HAIP_TLS_MODE);

        $haip = $this->getTransipApi()->haip()->getByName($haipName);
        $haip->setTlsMode($tlsMode);

        $this->getTransipApi()->haip()->update($haip);
    }
}
