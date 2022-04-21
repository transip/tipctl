<?php

namespace Transip\Api\CLI\ConsoleOutput\Interfaces;

interface OutputInterface
{
    /**
     * @param mixed $data
     * @return string
     */
    public function render($data): string;
}
