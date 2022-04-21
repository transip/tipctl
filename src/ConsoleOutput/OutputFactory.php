<?php

namespace Transip\Api\CLI\ConsoleOutput;

use RuntimeException;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\ConsoleOutput\Interfaces\OutputInterface;

final class OutputFactory
{
    public static function create(?string $formatType): OutputInterface
    {
        if ($formatType) {
            $formatType = strtolower($formatType);

            switch ($formatType) {
                case 'json': return new JsonOutput();
                case 'yaml': return new YamlOutput();
                case 'txt':  return new TxtOutput();
            }
        }
       
        throw new RuntimeException("Given output format `{$formatType}` is incorrect; Use ". lcfirst(Field::FORMAT__DESC));
    }
}
