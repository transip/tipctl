<?php

namespace Transip\Api\CLI\Command\ApiTest;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Settings\Settings;

class RequestAccessToken extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('apitest:requestaccesstoken')
            ->setDescription('Use key to create a temporary access token')
            ->setHelp('Use keypair generated in the Control Panel to create a temporary access token');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $settings = Settings::getInstance();
        $token = $this->getTransipApi()->auth()->createToken($settings->getApiLogin(), $settings->getApiPrivateKey() ,"test-" . rand(0,9999));
        $this->output($token);
    }
}
