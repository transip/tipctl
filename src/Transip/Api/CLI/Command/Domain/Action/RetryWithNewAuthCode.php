<?php

namespace Transip\Api\CLI\Command\Domain\Action;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class RetryWithNewAuthCode extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('Domain:Action:retryWithNewAuthCode')
            ->setDescription('Retry a failed domain action with new information')
            ->setHelp('Provide a name to retrieve the current running action for a specific domain')
            ->addArgument(Field::DOMAIN_NAME, InputArgument::REQUIRED, Field::DOMAIN_NAME__DESC)
            ->addArgument(Field::DOMAIN_AUTH_CODE, InputArgument::REQUIRED, Field::DOMAIN_AUTH_CODE__DESC);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domainName = $input->getArgument(Field::DOMAIN_NAME);
        $authCode   = $input->getArgument(Field::DOMAIN_AUTH_CODE);
        $this->getTransipApi()->domainAction()->retryDomainAction($domainName, $authCode);
    }
}
