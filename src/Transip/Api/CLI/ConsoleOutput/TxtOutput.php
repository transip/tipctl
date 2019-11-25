<?php

namespace Transip\Api\CLI\ConsoleOutput;

class TxtOutput extends AbstractOutput
{
    public function render(): string
    {
        $data = $this->data;

        if (is_array($data) || is_object($data)) {
            return print_r($data, true);
        }

        return $data;
    }
}
