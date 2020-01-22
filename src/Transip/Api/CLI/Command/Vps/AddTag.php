<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class AddTag extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:addtag')
            ->setDescription('Add a tag on to your VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::TAG_NAME, InputArgument::REQUIRED, Field::TAG_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $tagName = $input->getArgument(Field::TAG_NAME);

        $vps = $this->getTransipApi()->vps()->getByName($vpsName);
        $vps->addTag($tagName);

        $this->getTransipApi()->vps()->update($vps);
    }
}
