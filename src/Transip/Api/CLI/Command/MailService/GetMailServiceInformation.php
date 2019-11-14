<?php

namespace Transip\Api\CLI\Command\MailService;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;

class GetMailServiceInformation extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('MailService:getMailServiceInformation')
            ->setDescription('Get the Mail Service usage');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $mailServiceInformation = $this->getTransipApi()->mailService()->getMailServiceInformation();

        $output->writeln(print_r($mailServiceInformation, 1));
    }
}