<?php

namespace CleaniqueCoders\KongAdminApi\Api;

use CleaniqueCoders\KongAdminApi\Connector;
use CleaniqueCoders\KongAdminApi\Contracts\Client;
use DateTime;
use Exception;
use Saloon\Enums\Method;
use Saloon\Http\Response;

/**
 * Class ApiClient
 *
 * The client for interacting with the Kong Admin API.
 */
class ApiClient implements Client
{
    /**
     * Status code from the API response.
     */
    protected string $status_code;

    /**
     * Status phrase from the API response.
     */
    protected string $status_phrase;

    /**
     * The base path for the API resource.
     */
    protected string $path;

    /**
     * Identifier for a specific resource.
     */
    protected ?string $identifier = null;

    /**
     * Data for requests.
     *
     * @var array<string, mixed>
     */
    protected array $data = [];

    /**
     * ApiClient constructor.
     *
     * @param  Connector  $connector  The API connector
     */
    public function __construct(protected Connector $connector) {}

    /**
     * Processes the API response and returns an ApiResponse instance.
     *
     * @param  Response  $response  The Saloon response object
     * @return ApiResponse An object containing the processed response data
     */
    protected function response(Response $response): ApiResponse
    {
        return new ApiResponse(
            (string) $response->status(),
            $response->getPsrResponse()->getReasonPhrase(),
            $response->json(),
            new DateTime
        );
    }

    /**
     * Build the API path with optional identifier.
     *
     * @return string The full path to the resource
     *
     * @throws Exception If the path is not defined
     */
    protected function buildPath(): string
    {
        if (empty($this->path)) {
            throw new Exception('Undefined path requested', 1);
        }

        return $this->connector->resolveBaseUrl().'/'.$this->path.($this->identifier ? '/'.$this->identifier : '');
    }

    public function statusCode(): string
    {
        return $this->status_code;
    }

    public function statusPhrase(): string
    {
        return $this->status_phrase;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Set data for requests.
     *
     * @param  array<string, mixed>  $data  The data for the request
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Retrieve the data set for requests.
     *
     * @return array<string, mixed> The data to be sent in requests
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Send a request to the API with the specified HTTP method and data.
     *
     * @param  Method  $method  The HTTP method to use
     * @param  array<string, mixed>  $data  The data to include in the request
     * @return ApiResponse The structured API response
     */
    public function sendRequest(Method $method, array $data = []): ApiResponse
    {
        $request = (new ApiRequest)
            ->setMethod($method)
            ->setEndpoint($this->buildPath());

        if (! empty($data) && in_array($method, [Method::POST, Method::PATCH, Method::DELETE])) {
            $request->body()->set($data);
        }

        $response = $this->connector->send($request);

        return $this->response($response);
    }

    /**
     * Retrieve a list of resources.
     *
     * @return array<string, mixed> The list of resources
     */
    public function index(): array
    {
        return $this->sendRequest(Method::GET)->toArray();
    }

    /**
     * Store a new resource with the provided data.
     *
     * @param  array<string, mixed>  $data  The data to create the resource
     * @return array<string, mixed> The created resource or result of the operation
     */
    public function store(array $data): array
    {
        $this->setData($data);

        return $this->sendRequest(Method::POST, $this->getData())->toArray();
    }

    /**
     * Update a specific resource by its identifier with the provided data.
     *
     * @param  string  $identifier  The unique identifier for the resource
     * @param  array<string, mixed>  $data  The data to update the resource
     * @return array<string, mixed> The updated resource or result of the operation
     */
    public function update(string $identifier, array $data): array
    {
        $this->setIdentifier($identifier)->setData($data);

        return $this->sendRequest(Method::PATCH, $this->getData())->toArray();
    }

    /**
     * Show a specific resource by its identifier.
     *
     * @param  string  $identifier  The unique identifier for the resource
     * @return array<string, mixed> The resource data
     */
    public function show(string $identifier): array
    {
        $this->setIdentifier($identifier);

        return $this->sendRequest(Method::GET)->toArray();
    }

    /**
     * Delete a specific resource by its identifier.
     *
     * @param  string  $identifier  The unique identifier for the resource
     * @return array<string, mixed> The result of the delete operation
     */
    public function delete(string $identifier): array
    {
        $this->setIdentifier($identifier);

        return $this->sendRequest(Method::DELETE)->toArray();
    }
}
