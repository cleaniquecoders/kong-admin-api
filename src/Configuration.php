<?php

namespace CleaniqueCoders\KongAdminApi;

class Configuration
{
    protected string $base;

    protected string $uri;

    protected string $apiKey;

    protected string $keyName;

    protected array $headers;

    protected bool $verify;

    /**
     * Constructor to initialize the configuration.
     *
     * @param  string  $base  Base URL for Kong Admin
     * @param  string  $uri  URI for Kong Admin API
     * @param  string  $apiKey  API key for authentication
     * @param  string  $keyName  API key name for authentication
     * @param  array  $headers  Headers for requests
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

    public function getBase(): string
    {
        return $this->base;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getKeyName(): string
    {
        return $this->keyName;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function shouldVerify(): bool
    {
        return $this->verify;
    }
}
