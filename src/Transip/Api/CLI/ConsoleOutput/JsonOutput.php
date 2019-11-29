<?php

namespace Transip\Api\CLI\ConsoleOutput;

class JsonOutput extends AbstractOutput
{
    public function render(): string
    {
        $output = json_encode($this->data, JSON_PRETTY_PRINT);

        if ($output === false) {
            throw new \RuntimeException('Failed to parse provided data: ' . print_r($this->data, true));
        }

        return $output;
    }
}
