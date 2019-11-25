<?php

namespace Transip\Api\CLI\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutput;
use Transip\Api\CLI\Output\Formatter;
use Transip\Api\Client\TransipAPI;

abstract class AbstractCommand extends Command
{
    /**
     * @var TransipAPI $transipApi
     */
    private $transipApi;

    public function __construct(string $name = null)
    {
        $apiurl = '';
        $token  = '';

        $this->transipApi = new TransipAPI($token, $apiurl);
        parent::__construct($name);

        $this->addOption(Field::FORMAT, null, InputOption::VALUE_OPTIONAL, Field::FORMAT__DESC, 'json');
    }

    public function getTransipApi(): TransipAPI
    {
        return $this->transipApi;
    }

    /**
     * @throws \Exception
     */
    public function output($data, string $outputFormat): void
    {
        $outputFormat = strtolower($outputFormat);
        $outputFormat = ucfirst($outputFormat);
        $className = '\\Transip\\Api\\CLI\\Output\\'. $outputFormat . 'Output';

        $formatter = new Formatter();
        $formatter->ensureGivenFormatTypeIsValid($outputFormat);
        $data = $formatter->format(new $className($data));

        $output = new ConsoleOutput();
        $output->writeln($data);
    }
}
