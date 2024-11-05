<?php

namespace CleaniqueCoders\KongAdminApi;

/**
 * Interface API
 *
 * Defines the required methods for interacting with the Kong Admin API.
 */
interface API
{
    /**
     * Get the API path for this resource.
     *
     * @return string The path to the API resource
     */
    public function path(): string;

    /**
     * Retrieve a list of resources.
     *
     * @return mixed A collection or list of resources
     */
    public function index();

    /**
     * Store a new resource with the provided data.
     *
     * @param  mixed  $data  The data to store the resource
     * @return mixed The created resource or result of the store operation
     */
    public function store($data);

    /**
     * Show a specific resource by its identifier.
     *
     * @param  mixed  $identifier  The unique identifier for the resource
     * @return mixed The resource data
     */
    public function show($identifier);

    /**
     * Delete a specific resource by its identifier.
     *
     * @param  mixed  $identifier  The unique identifier for the resource
     * @return mixed The result of the delete operation
     */
    public function delete($identifier);

    /**
     * Test the connection to the Kong Admin API.
     *
     * @return mixed The result of the connection test
     */
    public function testConnection();
}
