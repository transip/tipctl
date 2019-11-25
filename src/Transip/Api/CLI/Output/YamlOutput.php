<?php

namespace Transip\Api\CLI\Output;

use Transip\Api\CLI\Command\AbstractCommand;
use Symfony\Component\Yaml\Yaml;

class YamlOutput extends AbstractCommand
{
    public function parse()
    {
        $data = $this->data;
        $output = $data;

        if (is_array($data) || is_object($data)) {
            $output = Yaml::dump($data);
        }

        return $output;
    }
}
