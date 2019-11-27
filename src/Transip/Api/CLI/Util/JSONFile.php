<?php

namespace Transip\Api\CLI\Util;

use \RuntimeException;

/**
 * Class JSONFile deals with reading from and writing to json files.
 */
class JSONFile
{
    public static function read(string $filePath): array
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new RuntimeException("File '{$filePath}' could not be opened, make sure the file exists.");
        }

        $fileData = file_get_contents($filePath);
        $jsonData = json_decode($fileData, true);

        if ($jsonData === null) {
            throw new RuntimeException("Failed to json decode: '{$filePath}'");
        }

        return $jsonData;
    }

    public static function write(string $filePath, array $data): bool
    {
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        if ($jsonData === false) {
            throw new RuntimeException('Could not json encode data: ' . print_r($data, true));
        }

        $write = file_put_contents($filePath, $jsonData);
        if ($write === false) {
            throw new RuntimeException("Unable to write to file {$filePath}");
        }

        return true;
    }
}
