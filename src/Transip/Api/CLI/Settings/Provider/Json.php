<?php

namespace Transip\Api\CLI\Settings\Provider;

use \RuntimeException;

/**
 * Class Json deals with writing to and reading from json files.
 */
class Json
{
    /**
     * @var string
     */
    protected $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Reads a json file and decodes the data in to an array
     *
     * @throws RuntimeException
     */
    public function read(): array
    {
        if (!file_exists($this->filePath) || !is_readable($this->filePath)) {
            throw new RuntimeException("Failed to open settings file '{$this->filePath}', perhaps the file does not exist?");
        }

        $fileData = file_get_contents($this->filePath);
        $jsonData = json_decode($fileData, true);

        if ($jsonData === null) {
            throw new RuntimeException("Failed to parse settings file '{$this->filePath}', are you sure this is valid json?");
        }

        return $jsonData;
    }

    /**
     * Encodes an array to json and writes to a json file
     *
     * @throws RuntimeException
     */
    public function write(array $data): bool
    {
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        if ($jsonData === false) {
            throw new RuntimeException('Failed to parse provided data: ' . print_r($data, true));
        }

        $write = file_put_contents($this->filePath, $jsonData);
        if ($write === false) {
            throw new RuntimeException("Failed to write to file {$this->filePath}, maybe permissions are not set correctly?");
        }

        return true;
    }
}
