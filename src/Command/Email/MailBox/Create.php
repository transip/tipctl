<?php

declare(strict_types=1);

namespace Transip\Api\CLI\Command\Email\MailBox;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Create extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('email:mailbox:create')
            ->setDescription('Create a mailbox')
            ->setHelp('Add mailbox to your account')
            ->addArgument(Field::EMAIL_DOMAIN_NAME, InputArgument::REQUIRED, Field::EMAIL_DOMAIN_NAME__DESC)
            ->addArgument(Field::EMAIL_LOCALPART, InputArgument::REQUIRED, Field::EMAIL_LOCALPART__DESC)
            ->addArgument(Field::EMAIL_MAXDISKUSAGE, InputArgument::REQUIRED, Field::EMAIL_MAXDISKUSAGE__DESC)
            ->addArgument(Field::EMAIL_PASSWORD, InputArgument::REQUIRED, Field::EMAIL_PASSWORD__DESC)
            ->addArgument(Field::EMAIL_MAILBOX_FORWARDTO, InputArgument::OPTIONAL, Field::EMAIL_MAILBOX_FORWARDTO__DESC, '');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::EMAIL_DOMAIN_NAME);
        $localPart = $input->getArgument(Field::EMAIL_LOCALPART);
        $maxDiskUsage = (int) $input->getArgument(Field::EMAIL_MAXDISKUSAGE);
        $password = $input->getArgument(Field::EMAIL_PASSWORD);
        $forwardTo = $input->getArgument(Field::EMAIL_MAILBOX_FORWARDTO);

        $this->getTransipApi()->mailboxes()->create(
            $domainName,
            $localPart,
            $maxDiskUsage,
            $password,
            $forwardTo
        );
        return 0;
    }
}
