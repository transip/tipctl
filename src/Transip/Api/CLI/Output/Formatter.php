<?php

namespace Transip\Api\CLI\Output;

use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Output\Interfaces\OutputInterface;
use Transip\Api\CLI\Utilities\Strings;

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

        return "\Transip\Api\CLI\Output\\". $outputFormat . 'Output';
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
        if (!in_array($format, self::getAllowedFormats(), true)) {
            throw new Exception("Given output format `{$format}` is incorrect; Use ".
                lcfirst(Field::FORMAT__DESC));
        }
    }

    /**
     * Scans the output directory and finds all existing Output format
     * classes available in the system.
     *
     * @return array
     */
    public static function getAllowedFormats(): array
    {
        $allowedFormats = [];

        $files = scandir(__DIR__);
        foreach ($files as $fileName) {
            if (!strpos($fileName, 'Output') || strpos($fileName, 'Abstract') !== false) {
                continue;
            }

            $formatType = explode('Output', $fileName);
            $allowedFormats[] = $formatType[0];
        }

        return $allowedFormats;
    }
}
