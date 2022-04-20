<?php

namespace Transip\Api\CLI\Command\Email\MailBox;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

use function explode;
use function filter_var;

class Delete extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('email:mailbox:delete')
            ->setDescription('Delete a mailbox')
            ->setHelp('Delete mailbox for email address')
            ->addArgument(Field::EMAIL_ADDRESS, InputArgument::REQUIRED, Field::EMAIL_ADDRESS__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getArgument(Field::EMAIL_ADDRESS);

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $output->writeln('<error>Please provide a valid email address</error>');
            return 1;
        }

        $domainName = explode('@', $email)[1];

        $this->getTransipApi()->mailboxes()->delete($email, $domainName);
        return 0;
    }
}
