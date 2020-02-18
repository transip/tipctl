<?php

namespace Transip\Api\CLI\ConsoleOutput\Interfaces;

interface OutputInterface
{
    public function render($data): string;
}
