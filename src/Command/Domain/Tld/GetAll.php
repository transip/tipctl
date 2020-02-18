<?php

namespace Transip\Api\CLI\Command\Domain\Tld;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetAll extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:tld:getall')
            ->setDescription('Get all available Tlds to register with price')
            ->addArgument(Field::PAGE, InputArgument::OPTIONAL, Field::PAGE__DESC . Field::OPTIONAL, 0)
            ->addArgument(Field::ITEMS_PER_PAGE, InputArgument::OPTIONAL, Field::ITEMS_PER_PAGE__DESC . Field::OPTIONAL, 0)
            ->setHelp('Get all the TLD information like price, min & max character length');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $page = $input->getArgument(Field::PAGE);
        $itemsPerPage = $input->getArgument(Field::ITEMS_PER_PAGE);
        $tlds = $this->getTransipApi()->domainTlds()->getSelection($page, $itemsPerPage);

        $this->output($tlds);
    }
}
