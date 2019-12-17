<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetDescription extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('haip:setDescription')
            ->setDescription('Set the description of a Haip')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(Field::HAIP_DESCRIPTION, InputArgument::REQUIRED, Field::HAIP_DESCRIPTION);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $description = $input->getArgument(Field::HAIP_DESCRIPTION);
        $haipName = $input->getArgument(Field::HAIP_NAME);

        $haip = $this->getTransipApi()->haip()->getByName($haipName);
        $haip->setDescription($description);
        $this->getTransipApi()->haip()->update($haip);
    }
}
