<?php

namespace Transip\Api\CLI\Command\Domain;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class AddTag extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:addTag')
            ->setDescription('Add a tag to a domain')
            ->setHelp('Provide a domain name and tag you would like to add')
            ->addArgument('DomainName', InputArgument::REQUIRED, 'DomainName')
            ->addArgument('TagName', InputArgument::REQUIRED, 'TagName');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument('DomainName');
        $tagName    = $input->getArgument('TagName');

        $domain = $this->getTransipApi()->domains()->getByName($domainName);
        $domain->addTag($tagName);
        $this->getTransipApi()->domains()->update($domain);

        $this->output($domain);
    }
}
