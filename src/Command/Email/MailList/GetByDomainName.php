<?php

namespace Transip\Api\CLI\Command\Email\MailList;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByDomainName extends AbstractCommand
{
    public function configure()
    {
        $this
            ->setName('email:maillist:getbydomainname')
            ->setDescription('List all mail lists for domain name')
            ->setHelp('Provide a domain name to retrieve all mail lists for that domain')
            ->addArgument(Field::EMAIL_DOMAIN_NAME, InputArgument::REQUIRED, Field::EMAIL_DOMAIN_NAME__DESC);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::EMAIL_DOMAIN_NAME);
        $mailLists = $this->getTransipApi()->mailLists()->getByDomainName($domainName);
        $this->output($mailLists);
    }
}
