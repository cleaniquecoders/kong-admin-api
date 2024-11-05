<?php

use CleaniqueCoders\KongAdminApi\Configuration;
use CleaniqueCoders\KongAdminApi\Connector;
use Saloon\Enums\Method;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;

// Custom test request class
class TestRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return 'resource';
    }
}

it('initializes the connector with the provided configuration', function () {
    $configuration = new Configuration(
        base: 'https://kong-admin.com',
        uri: 'api',
        apiKey: 'test-api-key',
        keyName: 'apikey'
    );

    $connector = new Connector($configuration);

    expect($connector)->toBeInstanceOf(Connector::class);
});

it('sends a request with default headers and authentication', function () {
    // Set up a mock client with a mock response
    $mockClient = new MockClient([
        MockResponse::make(['status' => 'success'], 200, [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'apikey' => 'test-api-key',
        ]),
    ]);

    // Configuration with specific headers
    $configuration = new Configuration(
        base: 'https://kong-admin.com',
        uri: 'api',
        apiKey: 'test-api-key',
        keyName: 'apikey',
        headers: [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]
    );

    // Initialize Connector with MockClient
    $connector = new Connector($configuration);
    $connector->withMockClient($mockClient);

    // Create and send the test request using Connector
    $request = new TestRequest;
    $response = $connector->send($request);

    expect($response->headers()->get('Content-Type'))->toBe('application/json')
        ->and($response->headers()->get('Accept'))->toBe('application/json')
        ->and($response->headers()->get('apikey'))->toBe('test-api-key')
        ->and($response->status())->toBe(200)
        ->and($response->json())->toBe(['status' => 'success']);
});
