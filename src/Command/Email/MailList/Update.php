<?php

namespace Transip\Api\CLI\Command\Email\MailList;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\Library\Entity\Email\MailList;

class Update extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('email:maillist:update')
            ->setDescription('Update a mail list')
            ->setHelp('Update existing mail list in your account')
            ->addArgument(Field::EMAIL_MAIL_LIST_ID, InputArgument::REQUIRED, Field::EMAIL_MAIL_LIST_ID__DESC)
            ->addArgument(Field::EMAIL_DOMAIN_NAME, InputArgument::REQUIRED, Field::EMAIL_DOMAIN_NAME__DESC)
            ->addArgument(Field::EMAIL_MAIL_LIST_NAME, InputArgument::REQUIRED, Field::EMAIL_MAIL_LIST_NAME__DESC)
            ->addArgument(Field::EMAIL_MAIL_LIST_ENTRIES, InputArgument::IS_ARRAY, Field::EMAIL_MAIL_LIST_ENTRIES__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $mailListId = $input->getArgument(Field::EMAIL_MAIL_LIST_ID);
        $domainName = $input->getArgument(Field::EMAIL_DOMAIN_NAME);
        $name = $input->getArgument(Field::EMAIL_MAIL_LIST_NAME);
        $entries = $input->getArgument(Field::EMAIL_MAIL_LIST_ENTRIES);

        $mailList = $this->getTransipApi()->mailLists()->getByDomainNameAndId($domainName, $mailListId);

        $mailList->setName($name);

        if ($entries !== null) {
            $mailList->setEntries($entries);
        }

        $this->getTransipApi()->mailLists()->update($mailListId, $domainName, $mailList);
        return 0;
    }
}
