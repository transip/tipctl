<?php

namespace Transip\Api\CLI\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class MailService extends AbstractCommand
{
    protected function configure()
    {
        $this->setName('MailService')
            ->setDescription('Mail Service usage and credentials')
            ->setHelp('')
            ->addArgument("action", InputArgument::REQUIRED, "")
            ->addUsage("getMailServiceInformation")
            ->addUsage("regenerateMailServicePassword")
            ->addUsage("addMailServiceDnsEntriesToDomains")
            ->addArgument("args", InputArgument::IS_ARRAY, "Optional arguments");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('action')) {
            case "getMailServiceInformation":
                $mailServiceInformation = $this->getTransipApi()->mailService()->getMailServiceInformation();
                $output->writeln(print_r($mailServiceInformation, 1));
                break;
            case "regenerateMailServicePassword":
                $this->getTransipApi()->mailService()->regenerateMailServicePassword();
                $mailServiceInformation = $this->getTransipApi()->mailService()->getMailServiceInformation();
                $output->writeln(print_r($mailServiceInformation, 1));
                break;
            case "addMailServiceDnsEntriesToDomains":
                $arguments = $input->getArgument('args');
                if (count($arguments) < 1) {
                    throw new \Exception("domain(s) (comma separated) is required");
                }

                $domains = $arguments[0];
                $domains = explode(',', $domains);

                $this->getTransipApi()->mailService()->addMailServiceDnsEntriesToDomains($domains);
                break;
            default:
                throw new \Exception("invalid action given '{$input->getArgument('action')}'");
        }
    }
}
