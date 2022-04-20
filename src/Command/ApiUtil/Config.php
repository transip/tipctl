<?php

namespace Transip\Api\CLI\Command\ApiUtil;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Settings\Settings;

class Config extends AbstractCommand
{
    protected function configure(): void
    {
        $this->setName('apiutil:config')
            ->setDescription('Get running config information')
            ->setHelp('Display the config currently in use');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $information = [
            'cliClient' =>
                [
                    'configFilePath' => Settings::getConfigFilePath(),
                ],
            'apiLib'    => [
                'version'                 => $this->getTransipApi()::TRANSIP_API_LIBRARY_VERSION,
                'endpoint'                => $this->getTransipApi()->getEndpointUrl(),
                'login'                   => $this->getTransipApi()->getLogin(),
                'generateWhitelistTokens' => $this->getTransipApi()->getGenerateWhitelistOnlyTokens(),
                'readOnlyMode'            => $this->getTransipApi()->getReadOnlyMode(),
            ],
        ];

        $this->output($information);
        return 0;
    }
}
