<?php

namespace Transip\Api\CLI\Command\Vps\RescueImage;

use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Boot extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('vps:rescueimage:boot')
            ->setDescription('Boot a rescue image on your VPS')
            ->setHelp('Provide a VPS name and Rescue Image name to boot the specified rescue image')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_RESCUE_IMAGE_NAME, InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName         = $input->getArgument(Field::VPS_NAME);
        $rescueImageName = $input->getArgument(Field::VPS_RESCUE_IMAGE_NAME);

        $this->getTransipApi()->vpsRescueImages()->bootRescueImage($vpsName, $rescueImageName);
        return 0;
    }
}
