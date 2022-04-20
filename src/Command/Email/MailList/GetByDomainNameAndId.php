<?php

namespace Transip\Api\CLI\Command\Email\MailList;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class GetByDomainNameAndId extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('email:maillist:getbydomainnameandid')
            ->setDescription('Get a mail list for domain name and id')
            ->setHelp('Provide a domain name and a mail list id to retrieve the mail list')
            ->addArgument(Field::EMAIL_DOMAIN_NAME, InputArgument::REQUIRED, Field::EMAIL_DOMAIN_NAME__DESC)
            ->addArgument(Field::EMAIL_MAIL_LIST_ID, InputArgument::REQUIRED, Field::EMAIL_MAIL_LIST_ID__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::EMAIL_DOMAIN_NAME);
        $mailListId = (int) $input->getArgument(Field::EMAIL_MAIL_LIST_ID);

        $mailList = $this->getTransipApi()->mailLists()->getByDomainNameAndId(
            $domainName,
            $mailListId
        );

        $this->output($mailList);
        return 0;
    }
}
