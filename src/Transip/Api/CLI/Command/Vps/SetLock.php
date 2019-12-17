<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetLock extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:setlock')
            ->setDescription('Lock a Vps')
            ->setHelp('Locking will prevent any action from being performed on your VPS.')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_SET_LOCK, InputArgument::REQUIRED, Field::VPS_SET_LOCK__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $setLock = $input->getArgument(Field::VPS_SET_LOCK);

        $vps = $this->getTransipApi()->vps()->getByName($vpsName);
        $vps->setIsCustomerLocked(filter_var($setLock, FILTER_VALIDATE_BOOLEAN));
        $this->getTransipApi()->vps()->update($vps);

        $this->output($vps);
    }
}
