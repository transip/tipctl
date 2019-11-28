<?php

namespace Transip\Api\CLI\Settings;

use \RuntimeException;
use Symfony\Component\Console\Helper\HelperInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Settings\SettingsParser\Json;
use Webmozart\PathUtil\Path;

class Settings
{
    private const CONFIG_DIR_NAME  = '.config/transip-api';
    private const CONFIG_FILE_NAME = 'cli-config.json';

    public const DEFAULT_API_URL = 'https://api.transip.nl/v6/';

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $apiToken;

    /**
     * @var string
     */
    private $showConfigFilePermissionWarning;

    /**
     * @var null|self
     */
    private static $instance;

    private function __construct()
    {
        $configFilePath = self::getConfigFileName(true);

        try {
            $data = (new Json($configFilePath))->read();
        } catch (RuntimeException $e) {
            throw new RuntimeException('Please run the setup command, the config file has not been set');
        }

        $this->apiUrl = $data[Field::API_URL];
        $this->apiToken = $data[Field::API_TOKEN];
        $this->showConfigFilePermissionWarning = $data[Field::SHOW_CONFIG_FILE_PERMISSION_WARNING];
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

    public function getShowConfigFilePermissionWarning(): string
    {
        return $this->showConfigFilePermissionWarning;
    }

    public static function getConfigDir(): string
    {
        $homeDirectory = Path::getHomeDirectory();
        return Path::join($homeDirectory, self::CONFIG_DIR_NAME);
    }

    public static function getConfigFileName($getFilePath = false): string
    {
        if ($getFilePath) {
            return Path::join(self::getConfigDir(), self::CONFIG_FILE_NAME);
        }

        return self::CONFIG_FILE_NAME;
    }

    public function ensureConfigFileIsReadOnly(HelperInterface $formatter, OutputInterface $output): void
    {
        if ($this->getShowConfigFilePermissionWarning() === true) {
            return;
        }

        $configFilePath = self::getConfigFileName(true);

        clearstatcache();
        $filePermissions = substr(sprintf('%o', fileperms($configFilePath)), -4);

        if ($filePermissions === '0600') {
            return;
        }

        $messages = [
            'Warning: It is advised to set the config file to read only.',
            '',
            'To disable this warning message please edit the config file and set `'.
                Field::SHOW_CONFIG_FILE_PERMISSION_WARNING. '` to `disabled`.',
            '',
            "Config file can be found in: {$configFilePath}",
        ];
        $warning = $formatter->formatBlock(
            $messages,
            'bg=yellow;fg=black',
            true
        );
        $output->writeln('');
        $output->writeln($warning);
        $output->writeln('');
    }
}
