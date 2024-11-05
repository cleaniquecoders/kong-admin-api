<?php

namespace CleaniqueCoders\KongAdminApi;

class Configuration
{
    protected string $url;

    protected string $key;

    protected string $key_name;

    /**
     * Constructor to initialize the Admin API URL and API key.
     *
     * @param  string  $url  URL for Kong Admin API
     * @param  string  $key  API key for authentication
     * @param  string  $key_name  API key Name for authentication
     */
    public function __construct(string $url, string $key, string $key_name = 'apikey')
    {
        $this->url = $url;
        $this->key = $key;
        $this->key_name = $key_name;
    }

    /**
     * Get the Admin API URL.
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Get the API key for authentication.
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Get the API Key Name use for authentication.
     */
    public function getKeyName(): string
    {
        return $this->key_name;
    }
}
