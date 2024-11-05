<?php

namespace CleaniqueCoders\KongAdminApi\Contracts;

use CleaniqueCoders\KongAdminApi\Request;
use CleaniqueCoders\KongAdminApi\Response;

/**
 * Interface Client
 *
 * Defines the required methods for interacting with the Kong Admin API.
 */
interface Client
{
    /**
     * Send an API Request
     *
     * @param  Request  $request  The API request
     * @param  array<string, mixed>  $data  The data to include in the request
     * @return Response The structured API response
     */
    public function send(Request $request, array $data = []): Response;

    /**
     * Processes the API response and returns an Response instance.
     *
     * @param  \Saloon\Http\Response  $response  The Saloon response object
     * @return Response An object containing the processed response data
     */
    public function response(\Saloon\Http\Response $response): Response;
}
