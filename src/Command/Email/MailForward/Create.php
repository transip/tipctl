<?php

namespace Transip\Api\CLI\Command\Email\MailForward;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class Create extends AbstractCommand
{
    public function configure()
    {
        $this
            ->setName('email:mailforward:create')
            ->setDescription('Create a mail forward')
            ->setHelp('Add mail forward to your account')
            ->addArgument(Field::EMAIL_DOMAIN_NAME, InputArgument::REQUIRED, Field::EMAIL_DOMAIN_NAME__DESC)
            ->addArgument(Field::EMAIL_LOCALPART, InputArgument::REQUIRED, Field::EMAIL_LOCALPART__DESC)
            ->addArgument(Field::EMAIL_FORWARD_FORWARDTO, InputArgument::REQUIRED, Field::EMAIL_FORWARD_FORWARDTO__DESC);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::EMAIL_DOMAIN_NAME);
        $localPart = $input->getArgument(Field::EMAIL_LOCALPART);
        $forwardTo = $input->getArgument(Field::EMAIL_FORWARD_FORWARDTO);

        $this->getTransipApi()->mailForwards()->create(
            $domainName,
            $localPart,
            $forwardTo
        );
    }
}
