<?php

namespace Transip\Api\CLI\ConsoleOutput;

use Symfony\Component\Console\Input\InputInterface;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\ConsoleOutput\Interfaces\OutputInterface;

class Formatter
{
    /**
     * This method determines the class name that will be loaded to parse an array
     *
     * @param  InputInterface  $input
     * @return string
     * @throws \RuntimeException
     */
    public function prepare(InputInterface $input): string
    {
        $formatType   = $input->getOption(Field::FORMAT);
        $outputFormat = strtolower($formatType);

        $this->ensureGivenFormatTypeIsValid($outputFormat);

        return "\Transip\Api\CLI\ConsoleOutput\\". ucfirst($outputFormat) . 'Output';
    }

    /**
     * @see \Transip\Api\CLI\ConsoleOutput\AbstractOutput
     */
    public function format(OutputInterface $output): string
    {
        return $output->render();
    }

    /**
     * @throws \RuntimeException
     */
    public function ensureGivenFormatTypeIsValid(string $format): void
    {
        if (!in_array($format, ['json', 'yaml', 'txt'], true)) {
            throw new \RuntimeException("Given output format `{$format}` is incorrect; Use ".
                lcfirst(Field::FORMAT__DESC));
        }
    }
}
