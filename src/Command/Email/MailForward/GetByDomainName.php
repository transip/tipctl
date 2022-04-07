<?php

namespace Transip\Api\CLI\Command\Email\MailForward;

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
            ->setName('email:mailforward:getbydomainname')
            ->setDescription('List all mail forwards for domain name')
            ->setHelp('Provide a domain name to retrieve all mail forwards for that domain')
            ->addArgument(Field::EMAIL_DOMAIN_NAME, InputArgument::REQUIRED, Field::EMAIL_DOMAIN_NAME__DESC);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::EMAIL_DOMAIN_NAME);

        $forwards = $this->getTransipApi()->mailForwards()->getByDomainName($domainName);
        $this->output($forwards);
    }
}
