<?php

namespace Transip\Api\CLI\Output;

use Symfony\Component\Yaml\Yaml;

class YamlOutput extends AbstractOutput
{
    public function parse()
    {
        // converts object to array
        $output = json_decode(json_encode($this->data), true);

        // convert array to yaml
        $output = Yaml::dump($output);

        return $output;
    }
}
