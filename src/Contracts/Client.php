<?php

namespace CleaniqueCoders\KongAdminApi\Contracts;

use CleaniqueCoders\KongAdminApi\Api\ApiRequest;
use CleaniqueCoders\KongAdminApi\Api\ApiResponse;
use Saloon\Enums\Method;

/**
 * Interface Client
 *
 * Defines the required methods for interacting with the Kong Admin API.
 */
interface Client
{
    /**
     * Set the resource path.
     *
     * @param  string  $path  The API path for this resource
     */
    public function setPath(string $path): self;

    /**
     * Get the API path for this resource.
     *
     * @return string The path to the API resource
     */
    public function getPath(): string;

    /**
     * Set the unique identifier for a resource.
     *
     * @param  string  $identifier  The unique identifier for the resource
     */
    public function setIdentifier(string $identifier): self;

    /**
     * Get the unique identifier for a resource.
     *
     * @return string|null The unique identifier for the resource
     */
    public function getIdentifier(): ?string;

    /**
     * Set the data to be used in requests.
     *
     * @param  array<string, mixed>  $data  The data to use in requests
     */
    public function setData(array $data): self;

    /**
     * Get the data set for requests.
     *
     * @return array<string, mixed> The data for requests
     */
    public function getData(): array;

    /**
     * Send a request to the API with the specified HTTP method and data.
     *
     * @param  ApiRequest  $request  The API request
     * @param  array<string, mixed>  $data  The data to include in the request
     * @return ApiResponse The structured API response
     */
    public function sendRequest(ApiRequest $request, array $data = []): ApiResponse;

    /**
     * Retrieve a list of resources.
     *
     * @return array<string, mixed> A collection or list of resources
     */
    public function index(): array;

    /**
     * Store a new resource with the provided data.
     *
     * @param  array<string, mixed>  $data  The data to store the resource
     * @return array<string, mixed> The created resource or result of the store operation
     */
    public function store(array $data): array;

    /**
     * Show a specific resource by its identifier.
     *
     * @param  string  $identifier  The unique identifier for the resource
     * @return array<string, mixed> The resource data
     */
    public function show(string $identifier): array;

    /**
     * Update a specific resource by its identifier with the provided data.
     *
     * @param  string  $identifier  The unique identifier for the resource
     * @param  array<string, mixed>  $data  The data to update the resource
     * @return array<string, mixed> The updated resource or result of the update operation
     */
    public function update(string $identifier, array $data): array;

    /**
     * Delete a specific resource by its identifier.
     *
     * @param  string  $identifier  The unique identifier for the resource
     * @return array<string, mixed> The result of the delete operation
     */
    public function delete(string $identifier): array;
}
