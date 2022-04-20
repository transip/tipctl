<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class AddTag extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('domain:addtag')
            ->setDescription('Add a tag to a domain')
            ->setHelp('Provide a domain name and tag you would like to add')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(Field::TAG_NAME, InputArgument::REQUIRED, Field::TAG_NAME__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $tagName    = $input->getArgument(Field::TAG_NAME);

        $domain = $this->getTransipApi()->domains()->getByName($domainName);
        $domain->addTag($tagName);
        $this->getTransipApi()->domains()->update($domain);
        return 0;
    }
}
