<?php

namespace CleaniqueCoders\KongAdminApi;

use Saloon\Http\Connector as Base;

/**
 * Class Connector
 *
 * This class provides a connector for the Kong Admin API using the provided configuration.
 */
class Connector extends Base
{
    /**
     * Configuration instance for the Kong Admin API connection.
     */
    protected Configuration $configuration;

    /**
     * Constructor to initialize the connector with a configuration.
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
     * @return string The base URL from the configuration
     */
    public function resolveBaseUrl(): string
    {
        return $this->configuration->getUrl();
    }

    /**
     * Get the default headers for the Kong Admin API requests.
     *
     * @return array<string, string> The headers from the configuration
     */
    protected function defaultHeaders(): array
    {
        return $this->configuration->getHeaders();
    }
}
