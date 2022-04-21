<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:getall')
            ->setDescription('Get all of your Domains')
            ->addOption(Field::INCLUDE, null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL, FIELD::INCLUDE__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $includes = $input->getOption(Field::INCLUDE) ?? [];

        $domains = $this->getTransipApi()->domains()->getAll($includes);
        $this->output($domains);
        return 0;
    }
}
