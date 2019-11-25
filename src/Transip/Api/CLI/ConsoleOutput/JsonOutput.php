<?php

namespace Transip\Api\CLI\ConsoleOutput;

class JsonOutput extends AbstractOutput
{
    public function parse()
    {
        $data   = $this->data;
        $output = $data;

        if (is_array($data) || is_object($data)) {
            $output = json_encode($data, JSON_PRETTY_PRINT);
        }

        return $output;
    }
}
