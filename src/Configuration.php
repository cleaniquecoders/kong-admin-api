<?php

namespace CleaniqueCoders\KongAdminApi;

/**
 * Class Configuration
 *
 * This class holds configuration settings for connecting to the Kong Admin API.
 */
class Configuration
{
    /**
     * Base URL for Kong Admin.
     */
    protected string $base;

    /**
     * URI for Kong Admin API.
     */
    protected string $uri;

    /**
     * API key for authentication.
     */
    protected string $apiKey;

    /**
     * API key name for authentication.
     */
    protected string $keyName;

    /**
     * Headers for API requests.
     *
     * @var array<string, string>
     */
    protected array $headers;

    /**
     * Whether to verify SSL certificates.
     */
    protected bool $verify;

    /**
     * Constructor to initialize the configuration.
     *
     * @param  string  $base  Base URL for Kong Admin
     * @param  string  $uri  URI for Kong Admin API
     * @param  string  $apiKey  API key for authentication
     * @param  string  $keyName  API key name for authentication
     * @param  array<string, string>  $headers  Headers for requests
     * @param  bool  $verify  Whether to verify SSL certificates
     */
    public function __construct(
        string $base,
        string $uri,
        string $apiKey,
        string $keyName = 'apikey',
        array $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ],
        bool $verify = false
    ) {
        $this->base = $base;
        $this->uri = $uri;
        $this->apiKey = $apiKey;
        $this->keyName = $keyName;
        $this->headers = $headers;
        $this->verify = $verify;
    }

    /**
     * Get the base URL for Kong Admin.
     */
    public function getBase(): string
    {
        return $this->base;
    }

    /**
     * Get the URI for Kong Admin API.
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Get the API key for authentication.
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Get the API key name used for authentication.
     */
    public function getKeyName(): string
    {
        return $this->keyName;
    }

    /**
     * Get the headers for API requests.
     *
     * @return array<string, string>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Determine if SSL certificates should be verified.
     */
    public function shouldVerify(): bool
    {
        return $this->verify;
    }

    /**
     * Get the full URL for the Kong Admin API, combining base and URI.
     */
    public function getUrl(): string
    {
        return rtrim($this->getBase(), '/').'/'.trim($this->getUri(), '/');
    }
}
