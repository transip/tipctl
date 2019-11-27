<?php

namespace Transip\Api\CLI\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\Setup\Setup;
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

    public function __construct(string $name = null)
    {
        parent::__construct($name);

        $this->addOption(
            Field::FORMAT,
            null,
            InputOption::VALUE_OPTIONAL,
            Field::FORMAT__DESC,
            'json'
        );
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        if (!($this instanceof Setup)) {
            $settings = Settings::getInstance();
            $this->transipApi = new TransipAPI($settings->getApiToken(), $settings->getApiUrl());

            $settings->ensureConfigFileIsReadOnly($this->getHelperSet()->get('formatter'), $output);
        }

        $this->input  = $input;
        $this->output = $output;
    }

    public function getTransipApi(): TransipAPI
    {
        return $this->transipApi;
    }

    public function output($data): void
    {
        $formatter = new Formatter();
        $className = $formatter->prepare($this->input);
        $data      = $formatter->format(new $className($data));

        $this->output->writeln($data);
    }
}
