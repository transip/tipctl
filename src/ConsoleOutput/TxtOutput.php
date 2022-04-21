<?php

namespace Transip\Api\CLI\ConsoleOutput;

use Transip\Api\CLI\ConsoleOutput\Interfaces\OutputInterface;

class TxtOutput implements OutputInterface
{
    /**
     * @param mixed $data
     * @return string
     */
    public function render($data): string
    {
        if (is_array($data) || is_object($data)) {
            return print_r($data, true);
        }

        return $data;
    }
}
