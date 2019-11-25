<?php

namespace Transip\Api\CLI\Settings;

use Symfony\Component\Yaml\Yaml;

class Settings
{
    /**
     * @var string
     */
    private $apiUrl;
    /**
     * @var array
     */
    private $allowedOutputFormats;
    /**
     * @var string
     */
    private $apiToken;

    public function __construct()
    {
        $settings = file_get_contents(__DIR__ . '/settings.yml');
        $data = Yaml::parse($settings);

        $this->apiUrl = $data['apiUrl'];
        $this->apiToken = $data['apiToken'];
        $this->allowedOutputFormats = $data['allowedOutputFormats'];
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function getAllowedOutputFormats(): array
    {
        return $this->allowedOutputFormats;
    }

    public function getApiToken(): string
    {
        return $this->apiToken;
    }
}
