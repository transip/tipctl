<?php

namespace Transip\Api\CLI\ConsoleOutput;

use Transip\Api\CLI\ConsoleOutput\Interfaces\OutputInterface;

abstract class AbstractOutput implements OutputInterface
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    abstract public function parse();
}
