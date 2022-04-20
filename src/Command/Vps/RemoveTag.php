<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class RemoveTag extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:removetag')
            ->setDescription('Remove a tag from your VPS')
            ->addArgument(Field::VPS_NAME, InputArgument::REQUIRED, Field::VPS_NAME__DESC)
            ->addArgument(Field::TAG_NAME, InputArgument::REQUIRED, Field::TAG_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vpsName = $input->getArgument(Field::VPS_NAME);
        $tagName = $input->getArgument(Field::TAG_NAME);

        $vps = $this->getTransipApi()->vps()->getByName($vpsName);
        $vps->removeTag($tagName);

        $this->getTransipApi()->vps()->update($vps);
        return 0;
    }
}
