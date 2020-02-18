<?php

namespace Transip\Api\CLI\ConsoleOutput;

use Symfony\Component\Yaml\Yaml;
use Transip\Api\CLI\ConsoleOutput\Interfaces\OutputInterface;

class YamlOutput implements OutputInterface
{
    public function render($data): string
    {
        // converts object to array
        $output = json_decode(json_encode($data), true);

        // convert array to yaml
        $output = Yaml::dump($output);

        return $output;
    }
}
