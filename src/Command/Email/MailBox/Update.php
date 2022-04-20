<?php

declare(strict_types=1);

namespace Transip\Api\CLI\Command\Email\MailBox;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

use function explode;
use function filter_var;

class Update extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('email:mailbox:update')
            ->setDescription('Update a mailbox')
            ->setHelp('Update existing mailbox in your account')
            ->addArgument(Field::EMAIL_ADDRESS, InputArgument::REQUIRED, Field::EMAIL_ADDRESS__DESC)
            ->addArgument(Field::EMAIL_MAXDISKUSAGE, InputArgument::REQUIRED, Field::EMAIL_MAXDISKUSAGE__DESC)
            ->addArgument(Field::EMAIL_PASSWORD, InputArgument::REQUIRED, Field::EMAIL_PASSWORD__DESC)
            ->addArgument(Field::EMAIL_MAILBOX_FORWARDTO, InputArgument::OPTIONAL, Field::EMAIL_MAILBOX_FORWARDTO__DESC, '');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $emailAddress = $input->getArgument(Field::EMAIL_ADDRESS);

        if (! filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            $output->writeln('<error>Please provide a valid email address</error>');
            return 1;
        }

        $domain = explode('@', $emailAddress)[1];
        $maxDiskUsage = (int) $input->getArgument(Field::EMAIL_MAXDISKUSAGE);
        $password = $input->getArgument(Field::EMAIL_PASSWORD);
        $forwardTo = $input->getArgument(Field::EMAIL_MAILBOX_FORWARDTO);

        $this->getTransipApi()->mailboxes()->update(
            $emailAddress,
            $domain,
            $maxDiskUsage,
            $password,
            $forwardTo
        );
        return 0;
    }
}
