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

class GetByEmailAddress extends AbstractCommand
{
    public function configure()
    {
        $this
            ->setName('email:mailbox:getbyemailaddress')
            ->setDescription('List mailbox for email address')
            ->setHelp('Get mailbox by email address')
            ->addArgument(Field::EMAIL_ADDRESS, InputArgument::REQUIRED, Field::EMAIL_ADDRESS__DESC);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $email = $input->getArgument(Field::EMAIL_ADDRESS);

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $output->writeln('<error>Please provide a valid email address</error>');
            return;
        }

        $domainName = explode('@', $email)[1];
        $mailbox = $this->getTransipApi()->mailboxes()->getByDomainNameAndIdentifier($domainName, $email);

        $this->output($mailbox);
    }
}
