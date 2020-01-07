<?php

namespace Transip\Api\CLI\ConsoleOutput;

use Transip\Api\CLI\ConsoleOutput\Interfaces\OutputInterface;

class JsonOutput implements OutputInterface
{
    public function render($data): string
    {
        $output = json_encode($data, JSON_PRETTY_PRINT);

        if ($output === false) {
            throw new \RuntimeException('Failed to parse provided data: ' . print_r($data, true));
        }

        return $output;
    }
}
