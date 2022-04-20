<?php

namespace Transip\Api\CLI\Command\Email\MailForward;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Delete extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('email:mailforward:delete')
            ->setDescription('Delete a mail forward')
            ->setHelp('Delete a mail forward for domain name and id')
            ->addArgument(Field::EMAIL_DOMAIN_NAME, InputArgument::REQUIRED, Field::EMAIL_DOMAIN_NAME__DESC)
            ->addArgument(Field::EMAIL_FORWARD_ID, InputArgument::REQUIRED, Field::EMAIL_FORWARD_ID__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $domainName = $input->getArgument(Field::EMAIL_DOMAIN_NAME);
        $mailForwardId = (int) $input->getArgument(Field::EMAIL_FORWARD_ID);

        $this->getTransipApi()->mailForwards()->delete(
            $mailForwardId,
            $domainName
        );
        return 0;
    }
}
