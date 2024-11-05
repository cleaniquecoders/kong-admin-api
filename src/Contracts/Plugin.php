<?php

namespace CleaniqueCoders\KongAdminApi\Contracts;

use CleaniqueCoders\KongAdminApi\Enums\Endpoint;

/**
 * Interface Plugin
 *
 * Represents a plugin interface for interacting with Kong plugins.
 */
interface Plugin
{
    /**
     * Configure the request for a plugin-related endpoint.
     *
     * @param  \CleaniqueCoders\KongAdminApi\Enums\Plugin  $plugin  The plugin type
     * @param  Endpoint  $endpoint  The parent resource type (e.g., Endpoint::CONSUMERS, Endpoint::ROUTES, Endpoint::SERVICES)
     * @param  string  $identifier  The ID of the parent resource (e.g., consumer ID, route ID, or service ID)
     * @param  ?string  $plugin_identifier  Optional identifier for the specific plugin instance
     * @return $this
     */
    public function plugin(\CleaniqueCoders\KongAdminApi\Enums\Plugin $plugin, Endpoint $endpoint, string $identifier, ?string $plugin_identifier = null): self;

    /**
     * Determine if the current request is a plugin request to consumers, routes, or services.
     *
     * @return bool True if it's a plugin request to a specific resource type; otherwise, false.
     */
    public function isPluginRequest(): bool;
}
