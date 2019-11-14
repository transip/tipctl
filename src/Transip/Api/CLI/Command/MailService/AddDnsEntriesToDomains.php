<?php

namespace Transip\Api\CLI\Command\MailService;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class AddDnsEntriesToDomains extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('MailService:addDnsEntriesToDomains')
            ->setDescription('Add dns entries for the mailservice to a given domain')
            ->setHelp('domain(s) (comma separated) is required')
            ->addArgument("args", InputArgument::IS_ARRAY, "Optional arguments");

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arguments = $input->getArgument('args');

        if (count($arguments) < 1) {
            throw new \Exception($this->getHelp());
        }

        $domains = $arguments[0];
        $domains = explode(',', $domains);

        $this->getTransipApi()->mailService()->addMailServiceDnsEntriesToDomains($domains);
    }

}