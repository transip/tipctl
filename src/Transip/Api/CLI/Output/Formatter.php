<?php

namespace Transip\Api\CLI\Output;

use Exception;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Output\Interfaces\OutputInterface;

class Formatter
{
    public function format(OutputInterface $output): string
    {
        return $output->parse();
    }

    /**
     * @throws Exception
     */
    public function ensureGivenFormatTypeIsValid(string $format): void
    {
        if (!in_array($format, ['Json', 'Yaml'])) {
            throw new Exception('Given output format is incorrect; Use '. Field::FORMAT__DESC);
        }
    }
}
