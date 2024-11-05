<?php

namespace CleaniqueCoders\KongAdminApi\Api;

use CleaniqueCoders\KongAdminApi\Connector;
use CleaniqueCoders\KongAdminApi\Contracts\Client;
use DateTime;
use Saloon\Http\Response;

/**
 * Class ApiClient
 *
 * The client for interacting with the Kong Admin API.
 */
class ApiClient implements Client
{
    /**
     * ApiClient constructor.
     *
     * @param  Connector  $connector  The API connector
     */
    public function __construct(protected Connector $connector) {}

    /**
     * Send a request to the API with the specified HTTP method and data.
     *
     * @param  ApiRequest  $request  The API request
     * @param  array<string, mixed>  $data  The data to include in the request
     * @return ApiResponse The structured API response
     */
    public function send(ApiRequest $request, array $data = []): ApiResponse
    {
        $response = $this->connector->send($request);

        return $this->response($response);
    }

    /**
     * Processes the API response and returns an ApiResponse instance.
     *
     * @param  Response  $response  The Saloon response object
     * @return ApiResponse An object containing the processed response data
     */
    public function response(Response $response): ApiResponse
    {
        return new ApiResponse(
            (string) $response->status(),
            $response->getPsrResponse()->getReasonPhrase(),
            $response->json(),
            new DateTime
        );
    }
}
