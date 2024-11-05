<?php

namespace CleaniqueCoders\KongAdminApi;

class Config
{
    protected string $url;
    protected string $key;

    /**
     * Constructor to initialize the Admin API URL and API key.
     *
     * @param string $url   URL for Kong Admin API
     * @param string $key   API key for authentication
     */
    public function __construct(string $url, string $key)
    {
        $this->url = $url;
        $this->key = $key;
    }

    /**
     * Get the Admin API URL.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Get the API key for authentication.
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}
