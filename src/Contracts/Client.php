<?php

namespace CleaniqueCoders\KongAdminApi\Contracts;

use CleaniqueCoders\KongAdminApi\ApiRequest;
use CleaniqueCoders\KongAdminApi\ApiResponse;
use Saloon\Http\Response;

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
     * @param  ApiRequest  $request  The API request
     * @param  array<string, mixed>  $data  The data to include in the request
     * @return ApiResponse The structured API response
     */
    public function send(ApiRequest $request, array $data = []): ApiResponse;

    /**
     * Processes the API response and returns an ApiResponse instance.
     *
     * @param  Response  $response  The Saloon response object
     * @return ApiResponse An object containing the processed response data
     */
    public function response(Response $response): ApiResponse;
}
