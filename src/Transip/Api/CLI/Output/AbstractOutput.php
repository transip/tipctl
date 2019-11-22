<?php

namespace Transip\Api\CLI\Output;

use Transip\Api\CLI\Output\Interfaces\OutputInterface;

abstract class AbstractOutput implements OutputInterface
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    abstract public function parse();
}
