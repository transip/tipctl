<?php

namespace Transip\Api\CLI\Command\Domain\Tld;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetAdditionalContactFields extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:tld:additional-contact-fields')
            ->setDescription('Get all additional contact fields for a tld.')
            ->setHelp('Get all the additional fields needed to register or transfer a domain on this tld')
            ->addArgument(Field::TLD, InputArgument::REQUIRED, Field::TLD__DESC);

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $tld       = $input->getArgument(Field::TLD);
        $fields = $this->getTransipApi()->additionalContactFields()->getForTld($tld);

        $this->output($fields);
        return 0;
    }
}
