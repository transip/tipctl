<?php

namespace Transip\Api\CLI\Command\Vps\RescueImage;

use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Boot extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('vps:rescueimage:boot')
            ->setDescription('Boot a rescue image on your VPS')
            ->setHelp('Provide a VPS name and Rescue Image name to boot the specified rescue image. If the RescueImage supports it multiple ssh keys can be provided to load upon boot')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::VPS_RESCUE_IMAGE_NAME, InputArgument::REQUIRED)
            ->addOption(Field::SSH_KEY, null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL, Field::SSH_KEY__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName         = $input->getArgument(Field::VPS_NAME);
        $rescueImageName = $input->getArgument(Field::VPS_RESCUE_IMAGE_NAME);
        $sshKeys         = $input->getOption(Field::SSH_KEY);

        $this->getTransipApi()->vpsRescueImages()->bootRescueImage($vpsName, $rescueImageName, $sshKeys);
        return 0;
    }
}
