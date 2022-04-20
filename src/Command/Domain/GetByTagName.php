<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByTagName extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:getbytagname')
            ->setDescription('Get a list of Domains by tag name(s)')
            ->addArgument(Field::TAG_NAME, InputArgument::REQUIRED, Field::TAG_NAME__DESC . ' (more than one tag, comma separated)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $tagName = $input->getArgument(Field::TAG_NAME);
        $tagNames = explode(',', $tagName);

        $domains = $this->getTransipApi()->domains()->getByTagNames($tagNames);

        $this->output($domains);
        return 0;
    }
}
