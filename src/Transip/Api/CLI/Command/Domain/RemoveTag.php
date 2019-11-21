<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class RemoveTag extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:removeTag')
            ->setDescription('Remove a tag from a domain')
            ->setHelp('Provide a domain name and tag you would like to remove')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME)
            ->addArgument(Field::DOMAIN_TAG, InputArgument::REQUIRED, Field::DOMAIN_TAG__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $tagName    = $input->getArgument(Field::DOMAIN_TAG);

        $domain = $this->getTransipApi()->domains()->getByName($domainName);
        $domain->removeTag($tagName);
        $this->getTransipApi()->domains()->update($domain);

        $this->output($domain);
    }
}
