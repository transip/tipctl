<?php

namespace Transip\Api\CLI\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\ConsoleOutput\Formatter;
use Transip\Api\CLI\Settings\Settings;
use Transip\Api\Client\TransipAPI;

abstract class AbstractCommand extends Command
{
    /**
     * @var TransipAPI $transipApi
     */
    private $transipApi;

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var array
     */
    private $allowedOutputFormats;

    public function __construct(string $name = null)
    {
        $init = new Settings();
        $this->allowedOutputFormats = $init->getAllowedOutputFormats();

        $this->transipApi = new TransipAPI($init->getApiToken(), $init->getApiUrl());
        parent::__construct($name);

        $this->addOption(Field::FORMAT, null, InputOption::VALUE_OPTIONAL, Field::FORMAT__DESC, 'json');
    }

    public function getTransipApi(): TransipAPI
    {
        return $this->transipApi;
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->input  = $input;
        $this->output = $output;
    }

    public function output($data): void
    {
        $formatter = new Formatter();
        $className = $formatter->prepare($this->input, $this->allowedOutputFormats);
        $data      = $formatter->format(new $className($data));

        $this->output->writeln($data);
    }
}
