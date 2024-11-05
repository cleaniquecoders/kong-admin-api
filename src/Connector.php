<?php

namespace CleaniqueCoders\KongAdminApi;

use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\HeaderAuthenticator;
use Saloon\Http\Connector as Base;

/**
 * Class Connector
 *
 * Provides a connector for interacting with the Kong Admin API using the specified configuration.
 */
class Connector extends Base
{
    /**
     * The configuration instance for the Kong Admin API connection.
     */
    protected Configuration $configuration;

    /**
     * Initializes the connector with the provided configuration.
     *
     * @param  Configuration  $configuration  The configuration settings for the Kong Admin API
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Resolve the base URL for the Kong Admin API.
     *
     * @return string The base URL for the API from the configuration
     */
    public function resolveBaseUrl(): string
    {
        return $this->configuration->getUrl();
    }

    /**
     * Retrieve the default headers for requests to the Kong Admin API.
     *
     * @return array<string, string> An associative array of headers
     */
    protected function defaultHeaders(): array
    {
        return $this->configuration->getHeaders();
    }

    /**
     * Set up the default authentication for Kong Admin API requests.
     *
     * @return Authenticator The authenticator with API key and key name
     */
    protected function defaultAuth(): ?Authenticator
    {
        return new HeaderAuthenticator(
            $this->configuration->getApiKey(),
            $this->configuration->getKeyName()
        );
    }
}
