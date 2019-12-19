<?php

namespace Transip\Api\CLI\Command\Domain\Tld;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByTld extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:tld:getbytld')
            ->setDescription('Get information for specific TLD')
            ->setHelp('Provide a TLD for information like price on this TLD')
            ->addArgument(Field::TLD, InputArgument::REQUIRED, Field::TLD__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tld       = $input->getArgument(Field::TLD);
        $tldObject = $this->getTransipApi()->domainTlds()->getByTld($tld);
        $this->output($tldObject);
    }
}
