<?php

namespace CleaniqueCoders\KongAdminApi;

use CleaniqueCoders\KongAdminApi\Contracts\Client as Contract;
use DateTime;

/**
 * Class Client
 *
 * The client for interacting with the Kong Admin API.
 */
class Client implements Contract
{
    /**
     * Client constructor.
     *
     * @param  Connector  $connector  The API connector
     */
    public function __construct(protected Connector $connector) {}

    /**
     * Send a request to the API with the specified HTTP method and data.
     *
     * @param  Request  $request  The API request
     * @param  array<string, mixed>  $data  The data to include in the request
     * @return Response The structured API response
     */
    public function send(Request $request, array $data = []): Response
    {
        return $this->response(
            $this->connector->send($request)
        );
    }

    /**
     * Processes the API response and returns an Response instance.
     *
     * @param  \Saloon\Http\Response  $response  The Saloon response object
     * @return Response An object containing the processed response data
     */
    public function response(\Saloon\Http\Response $response): Response
    {
        return new Response(
            (string) $response->status(),
            $response->getPsrResponse()->getReasonPhrase(),
            $response->json(),
            new DateTime
        );
    }
}
