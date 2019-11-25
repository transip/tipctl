<?php

namespace Transip\Api\CLI\Output;

use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Output\Interfaces\OutputInterface;

class Formatter
{
    /**
     * Generates the class name that will be loaded to format an array
     *
     * @param  InputInterface  $input
     * @return string
     * @throws Exception
     */
    public function prepare(InputInterface $input): string
    {
        $formatType   = $input->getOption(Field::FORMAT);
        $outputFormat = ucfirst(strtolower($formatType));

        $this->ensureGivenFormatTypeIsValid($outputFormat);

        return '\\Transip\\Api\\CLI\\Output\\'. $outputFormat . 'Output';
    }

    /**
     * @see \Transip\Api\CLI\Output\AbstractOutput
     */
    public function format(OutputInterface $output): string
    {
        return $output->parse();
    }

    /**
     * @throws Exception
     */
    public function ensureGivenFormatTypeIsValid(string $format): void
    {
        // if you want to add a new format, don't forget to add an output class that extends AbstractOutput
        if (!in_array($format, ['Json', 'Yaml'])) {
            throw new Exception('Given output format is incorrect; Use '. Field::FORMAT__DESC);
        }
    }
}
