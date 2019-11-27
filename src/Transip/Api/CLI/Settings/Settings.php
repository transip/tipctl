<?php

namespace Transip\Api\CLI\Settings;

use \RuntimeException;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Util\JSONFile;
use Webmozart\PathUtil\Path;

class Settings
{
    private const CONFIG_DIR_NAME = '.transip';
    private const CONFIG_FILE_NAME = 'restApiConfig.json';

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $apiToken;

    /**
     * @var null|self
     */
    private static $instance = null;

    private function __construct()
    {
        $configFilePath = self::getConfigFileName(true);

        try {
            $data = JSONFile::read($configFilePath);
        } catch (RuntimeException $e) {
            throw new RuntimeException('Please run the setup command, the config file has not been set');
        }

        $this->apiUrl   = $data[Field::API_URL];
        $this->apiToken = $data[Field::API_TOKEN];
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    public static function getConfigDir(): string
    {
        $home_dir = Path::getHomeDirectory();
        return Path::join($home_dir, self::CONFIG_DIR_NAME);
    }

    public static function getConfigFileName($getFilePath = false): string
    {
        if ($getFilePath) {
            return Path::join(self::getConfigDir(), self::CONFIG_FILE_NAME);
        }

        return self::CONFIG_FILE_NAME;
    }
}
