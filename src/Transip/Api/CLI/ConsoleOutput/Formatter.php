<?php

namespace Transip\Api\CLI\ConsoleOutput;

use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\ConsoleOutput\Interfaces\OutputInterface;
use Transip\Api\CLI\Utilities\Strings;

class Formatter
{
    /**
     * This method determines the class name that will be loaded to parse an array
     *
     * @param  InputInterface  $input
     * @param  array  $allowedOutputFormats
     * @return string
     * @throws Exception
     */
    public function prepare(InputInterface $input, array $allowedOutputFormats): string
    {
        $formatType   = $input->getOption(Field::FORMAT);
        $outputFormat = strtolower($formatType);

        $this->ensureGivenFormatTypeIsValid($outputFormat, $allowedOutputFormats);

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
     * @throws Exception
     */
    public function ensureGivenFormatTypeIsValid(string $format, array $allowedFormats): void
    {
        if (!in_array($format, $allowedFormats, true)) {
            throw new Exception("Given output format `{$format}` is incorrect; Use ".
                lcfirst(Field::FORMAT__DESC));
        }
    }
}
