<?php

namespace CleaniqueCoders\KongAdminApi;

use CleaniqueCoders\KongAdminApi\Contracts\Plugin as PluginContract;
use CleaniqueCoders\KongAdminApi\Contracts\Request as RequestContract;
use CleaniqueCoders\KongAdminApi\Contracts\Resource;
use CleaniqueCoders\KongAdminApi\Enums\Endpoint;
use CleaniqueCoders\KongAdminApi\Enums\Plugin;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request as SaloonRequest;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Class Request
 *
 * Represents a generic API request that can be customized with HTTP methods,
 * endpoints, and JSON body handling.
 */
class Request extends SaloonRequest implements HasBody, PluginContract, RequestContract, Resource
{
    use HasJsonBody;

    /**
     * The endpoint for the API request.
     */
    protected Endpoint $endpoint;

    /**
     * The identifier for the API request.
     */
    protected string $identifier = '';

    /**
     * The data for the API request.
     *
     * @var array<string, mixed>
     */
    protected array $data = [];

    /**
     * Sets the HTTP method for the request.
     *
     * @param  Method  $method  The HTTP method to be used for the request (GET, POST, etc.)
     * @return $this
     */
    public function setMethod(Method $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Sets the endpoint for the API request.
     *
     * @param  Endpoint  $endpoint  The specific endpoint for the API request
     * @return $this
     */
    public function setEndPoint(Endpoint $endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Gets the endpoint for the API request.
     *
     * @return Endpoint The endpoint for the API request
     */
    public function getEndpoint(): Endpoint
    {
        return $this->endpoint;
    }

    /**
     * Sets the identifier for the API request.
     *
     * @param  string  $identifier  The specific identifier for the API request
     * @return $this
     */
    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Gets the identifier for the API request.
     *
     * @return string The identifier for the API request
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * Set the data for the API request.
     *
     * @param  array<string, mixed>  $data  Set the data for the API request
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->body()->set($data);

        return $this;
    }

    /**
     * Prepares a store request with POST method and data.
     *
     * @param  array<string, mixed>  $data  The data to store
     * @return $this
     */
    public function store(array $data): self
    {
        return $this
            ->setMethod(Method::POST)
            ->setData($data);
    }

    /**
     * Prepares an update request with PUT method, identifier, and data.
     *
     * @param  string  $identifier  The identifier for the resource to update
     * @param  array<string, mixed>  $data  The data for the update
     * @return $this
     */
    public function update(string $identifier, array $data): self
    {
        return $this
            ->setMethod(Method::PUT)
            ->setIdentifier($identifier)
            ->setData($data);
    }

    /**
     * Prepares a patch request with PATCH method, identifier, and data.
     *
     * @param  string  $identifier  The identifier for the resource to update
     * @param  array<string, mixed>  $data  The data for the update
     * @return $this
     */
    public function patch(string $identifier, array $data): self
    {
        return $this
            ->setMethod(Method::PATCH)
            ->setIdentifier($identifier)
            ->setData($data);
    }

    /**
     * Prepares a delete request with DELETE method and identifier.
     *
     * @param  string  $identifier  The identifier for the resource to delete
     * @return $this
     */
    public function delete(string $identifier): self
    {
        return $this
            ->setMethod(Method::DELETE)
            ->setIdentifier($identifier);
    }

    /**
     * Prepares a get request with GET method and optional identifier.
     *
     * @param  string|null  $identifier  The identifier for the resource to retrieve
     * @return $this
     */
    public function get(?string $identifier = null): self
    {
        $this->setMethod(Method::GET);

        if ($identifier !== null) {
            $this->setIdentifier($identifier);
        }

        return $this;
    }

    /**
     * Configure the request for a plugin-related endpoint.
     *
     * @param  Plugin  $plugin  The plugin type
     * @param  Endpoint  $endpoint  The parent resource type (e.g., Endpoint::CONSUMERS, Endpoint::ROUTES, Endpoint::SERVICES)
     * @param  string  $identifier  The ID of the parent resource (e.g., consumer ID, route ID, or service ID)
     * @param  ?string  $plugin_identifier  Optional identifier for the specific plugin instance
     * @return $this
     */
    public function plugin(Plugin $plugin, Endpoint $endpoint, string $identifier, ?string $plugin_identifier = null): self
    {
        // Construct the plugin-specific endpoint path
        $pluginEndpoint = match ($endpoint) {
            Endpoint::CONSUMERS => "consumers/{$identifier}/plugins",
            Endpoint::ROUTES => "routes/{$identifier}/plugins",
            Endpoint::SERVICES => "services/{$identifier}/plugins",
            default => throw new \InvalidArgumentException("Unsupported endpoint for plugins: {$endpoint->value}")
        };

        // Set the fully resolved endpoint and optional plugin identifier
        $this->endpoint = Endpoint::PLUGINS;
        $this->identifier = $plugin_identifier ? "{$pluginEndpoint}/{$plugin_identifier}" : $pluginEndpoint;

        // Set the plugin name in the data (for creating or updating plugins)
        $this->setData(['name' => $plugin->value]);

        return $this;
    }

    /**
     * Determine if the current request is a plugin request to consumers, routes, or services.
     *
     * @return bool True if it's a plugin request to a specific resource type; otherwise, false.
     */
    public function isPluginRequest(): bool
    {
        return $this->endpoint === Endpoint::PLUGINS &&
               preg_match('/^(consumers|routes|services)\//', $this->identifier) === 1;
    }

    /**
     * Resolve the endpoint for the request.
     *
     * @return string The resolved endpoint URL
     */
    public function resolveEndpoint(): string
    {
        return $this->isPluginRequest()
            ? $this->getIdentifier()
            : $this->getEndpoint()->value.(
                $this->getIdentifier() !== ''
                ? '/'.$this->getIdentifier()
                : ''
            );
    }
}
