<?php

namespace Transip\Api\CLI\Command\Vps\RescueImage;

use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetByVpsName extends AbstractCommand
{
    public function configure()
    {
        $this
            ->setName('vps:rescueimage:getbyvpsname')
            ->setDescription('List all available rescue images for your VPS')
            ->setHelp('Provide a VPS name to retrieve all available rescue images for your VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $vpsName       = $input->getArgument(Field::VPS_NAME);
        $rescueImages  = $this->getTransipApi()->vpsRescueImages()->getByVpsName($vpsName);
        $this->output($rescueImages);
    }
}
