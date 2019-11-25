<?php

namespace Transip\Api\CLI\Output;

use Transip\Api\CLI\Output\Interfaces\OutputInterface;

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
