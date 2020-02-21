<?php

namespace Transip\Api\CLI\Command\Vps;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByTagName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('vps:getbytagname')
            ->setDescription('Get a list of VPSs by tag name(s)')
            ->addArgument(Field::TAG_NAME, InputArgument::REQUIRED, Field::TAG_NAME__DESC . ' (more than one tag, comma separated)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $tagName = $input->getArgument(Field::TAG_NAME);
        $tagNames = explode(',', $tagName);

        $VPSs = $this->getTransipApi()->vps()->getByTagNames($tagNames);

        $this->output($VPSs);
    }
}
