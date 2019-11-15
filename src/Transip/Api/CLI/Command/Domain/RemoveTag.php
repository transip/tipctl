<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class RemoveTag extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:removeTag')
            ->setDescription('Remove a tag from a domain')
            ->setHelp('Provide a domain name and tag you would like to remove')
            ->addArgument('DomainName', InputArgument::REQUIRED, 'DomainName')
            ->addArgument('TagName', InputArgument::REQUIRED, 'TagName');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument('DomainName');
        $tagName    = $input->getArgument('TagName');

        $domain = $this->getTransipApi()->domains()->getByName($domainName);
        $domain->removeTag($tagName);
        $this->getTransipApi()->domains()->update($domain);

        $output->writeln(print_r($domain, 1));
    }
}
