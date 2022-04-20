<?php

namespace Transip\Api\CLI\Command\Email\MailList;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

use function sprintf;

class Create extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('email:maillist:create')
            ->setDescription('Create a mail list')
            ->setHelp('Add a new mail list to your account')
            ->addArgument(Field::EMAIL_DOMAIN_NAME, InputArgument::REQUIRED, Field::EMAIL_DOMAIN_NAME__DESC)
            ->addArgument(Field::EMAIL_LOCALPART, InputArgument::REQUIRED, Field::EMAIL_LOCALPART__DESC)
            ->addArgument(Field::EMAIL_MAIL_LIST_NAME, InputArgument::REQUIRED, Field::EMAIL_MAIL_LIST_NAME__DESC)
            ->addArgument(Field::EMAIL_MAIL_LIST_ENTRIES, InputArgument::IS_ARRAY, Field::EMAIL_MAIL_LIST_ENTRIES__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::EMAIL_DOMAIN_NAME);
        $localPart = $input->getArgument(Field::EMAIL_LOCALPART);
        $name = $input->getArgument(Field::EMAIL_MAIL_LIST_NAME);
        $entries = $input->getArgument(Field::EMAIL_MAIL_LIST_ENTRIES);

        $this->getTransipApi()->mailLists()->create(
            $domainName,
            $name,
            sprintf('%s@%s', $localPart, $domainName),
            $entries
        );
        return 0;
    }
}
