<?php

namespace Transip\Api\CLI\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Output\Formatter;
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

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->input  = $input;
        $this->output = $output;
    }

    public function output($data): void
    {
        $formatter = new Formatter();
        $className = $formatter->prepare($this->input);
        $data      = $formatter->format(new $className($data));

        $this->output->writeln($data);
    }
}
