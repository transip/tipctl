<?php

namespace Transip\Api\CLI\ConsoleOutput;

use RuntimeException;
use Symfony\Component\Yaml\Yaml;
use Transip\Api\CLI\ConsoleOutput\Interfaces\OutputInterface;

class YamlOutput implements OutputInterface
{
    /**
     * @param mixed $data
     * @return string
     */
    public function render($data): string
    {
        // converts object to array
        $encoded = json_encode($data);
        if (!is_string($encoded)) {
            throw new RuntimeException('Unable to encode data for response');
        }
        $output = json_decode($encoded, true);

        // convert array to yaml
        $output = Yaml::dump($output);

        return $output;
    }
}
