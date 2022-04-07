<?php

declare(strict_types=1);

namespace Transip\Api\CLI\Command\Email\MailBox;

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
            ->setName('email:mailbox:getbydomainname')
            ->setDescription('List all mailboxes for domain name')
            ->setHelp('Provide a domain name to retrieve all mailboxes for that domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $mailboxes = $this->getTransipApi()->mailboxes()->getByDomainName($domainName);

        $this->output($mailboxes);
    }
}
