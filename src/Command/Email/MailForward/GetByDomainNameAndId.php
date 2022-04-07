<?php

namespace Transip\Api\CLI\Command\Email\MailForward;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByDomainNameAndId extends AbstractCommand
{
    public function configure()
    {
        $this
            ->setName('email:mailforward:getbydomainnameandid')
            ->setDescription('Get a mail forward for domain name and id')
            ->setHelp('Provide a domain name and a mail forward id to retrieve the mail forward')
            ->addArgument(Field::EMAIL_DOMAIN_NAME, InputArgument::REQUIRED, Field::EMAIL_DOMAIN_NAME__DESC)
            ->addArgument(Field::EMAIL_FORWARD_ID, InputArgument::REQUIRED, Field::EMAIL_FORWARD_ID__DESC);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::EMAIL_DOMAIN_NAME);
        $mailForwardId = (int) $input->getArgument(Field::EMAIL_FORWARD_ID);

        $forwards = $this->getTransipApi()->mailForwards()->getByDomainNameAndId(
            $domainName,
            $mailForwardId
        );

        $this->output($forwards);
    }
}
