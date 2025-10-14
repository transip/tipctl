<?php

namespace Transip\Api\CLI\Settings;

use \RuntimeException;
use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Helper\HelperInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Path;
use Transip\Api\CLI\Command\Field;
use Transip\Api\CLI\Settings\Provider\Json;

class Settings
{
    private const DEFAULT_CONFIG_DIR_NAME  = '.config/transip-api';
    private const DEFAULT_CONFIG_FILE_NAME = 'cli-config.json';

    public const TRANSIP_API_ENDPOINT = 'https://api.transip.nl/v6';

    public const TRANSIP_CLI_VERSION = '6.34.2';

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $apiLogin;

    /**
     * @var string
     */
    private $apiPrivateKey;

    /**
     * @var bool
     */
    private $apiUseWhitelist;

    /**
     * @var string
     */
    private $showConfigFilePermissionWarning;

    /**
     * @var null|self
     */
    private static $instance;

    /**
     * @var string
     */
    private static $configFilePath;

    private function initialise(): void
    {
        $configFilePath = self::getConfigFilePath();

        try {
            $data = (new Json($configFilePath))->read();
        } catch (RuntimeException $e) {
            throw new RuntimeException('Please run the setup command, the config file has not been set');
        }

        $this->apiUrl                          = $data[Field::API_URL];
        $this->apiLogin                        = $data[Field::API_LOGIN];
        $this->apiPrivateKey                   = $data[Field::API_PRIVATE_KEY];
        $this->apiUseWhitelist                 = $data[Field::API_USE_WHITELIST];
        $this->showConfigFilePermissionWarning = $data[Field::SHOW_CONFIG_FILE_PERMISSION_WARNING];
    }

    /**
     * Demo mode is enabled, here we ensure that all properties in this class are empty.
     *
     * @return void
     */
    private function initialiseDemo(): void
    {
        $this->apiUrl                          = '';
        $this->apiLogin                        = '';
        $this->apiPrivateKey                   = '';
        $this->apiUseWhitelist                 = false;
        $this->showConfigFilePermissionWarning = '';
    }

    public static function getInstance(bool $isDemoMode): self
    {
        if (self::$instance === null) {
            self::$instance = new self();

            if (!$isDemoMode) {
                (self::$instance)->initialise();
            } else {
                (self::$instance)->initialiseDemo();
            }
        }

        return self::$instance;
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function getApiLogin(): string
    {
        return $this->apiLogin;
    }

    public function getApiPrivateKey(): string
    {
        return $this->apiPrivateKey;
    }

    public function getApiUseWhitelist(): bool
    {
        return $this->apiUseWhitelist;
    }

    public function getShowConfigFilePermissionWarning(): string
    {
        return $this->showConfigFilePermissionWarning;
    }

    public static function getConfigDir(): string
    {
        return Path::getDirectory(self::getConfigFilePath());
    }

    public static function getConfigFilePath(): string
    {
        return self::$configFilePath;
    }

    public function ensureConfigFileIsReadOnly(FormatterHelper $formatter, OutputInterface $output): void
    {
        if (!$this->getShowConfigFilePermissionWarning()) {
            return;
        }

        $configFilePath = self::getConfigFilePath();

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

    public static function setConfigFilePath(string $configFile): void
    {
        self::$configFilePath = $configFile;
    }

    public static function getDefaultConfigFilePath(): string
    {
        return Path::join(Path::getHomeDirectory(), self::DEFAULT_CONFIG_DIR_NAME, self::DEFAULT_CONFIG_FILE_NAME);
    }
}
