<?php

namespace Transip\Api\CLI\Command\ApiUtil;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Settings\Settings;

class RequestAccessToken extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('apiutil:requestaccesstoken')
            ->setDescription('Use key to create a temporary access token')
            ->addArgument(Field::READ_ONLY, InputArgument::OPTIONAL, Field::READ_ONLY__DESC, false)
            ->addArgument(Field::TOKEN_END_DATE, InputArgument::OPTIONAL, Field::TOKEN_END_DATE__DESC, '1 day')
            ->setHelp('Create a temporary access token');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $readOnly = filter_var($input->getArgument(Field::READ_ONLY), FILTER_VALIDATE_BOOLEAN);
        $expirationTime = $input->getArgument(Field::TOKEN_END_DATE);

        $settings = Settings::getInstance();
        $token = $this->getTransipApi()->auth()->createToken($settings->getApiLogin(), $settings->getApiPrivateKey(), "test-" . time(), $readOnly, '', $expirationTime);
        $output->writeLn($token);
    }
}
