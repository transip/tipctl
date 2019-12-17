<?php

namespace Transip\Api\CLI\Command\Haip;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\AbstractCommand;
use Transip\Api\CLI\Command\Field;

class SetHttpHealthCheck extends AbstractCommand
{
    private const CHECK_PATH = 'CheckPath';
    private const CHECK_PORT = 'CheckPort';
    private const CHECK_SSL  = 'CheckSSL';

    protected function configure(): void
    {
        $this->setName('haip:sethttphealthcheck')
            ->setDescription('Set the HA-IP http health check variables')
            ->addArgument(Field::HAIP_NAME, InputArgument::REQUIRED, Field::HAIP_NAME__DESC)
            ->addArgument(self::CHECK_PATH, InputArgument::REQUIRED, 'The path (URI) of the page to check HTTP status code on')
            ->addArgument(self::CHECK_PORT, InputArgument::REQUIRED, 'The port to perform the HTTP check on')
            ->addArgument(self::CHECK_SSL, InputArgument::REQUIRED, 'Whether to use SSL when performing the HTTP check');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $haipName = $input->getArgument(Field::HAIP_NAME);
        $port     = intval($input->getArgument(self::CHECK_PORT));
        $path     = $input->getArgument(self::CHECK_PATH);

        $isSsl = $input->getArgument(self::CHECK_SSL);
        $isSsl = filter_var($isSsl, FILTER_VALIDATE_BOOLEAN);

        $haip = $this->getTransipApi()->haip()->getByName($haipName);

        $haip->setHttpHealthCheckPort($port);
        $haip->setHttpHealthCheckPath($path);
        $haip->setHttpHealthCheckSsl($isSsl);

        $this->getTransipApi()->haip()->update($haip);
    }
}
