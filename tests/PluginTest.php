<?php

use CleaniqueCoders\KongAdminApi\Client;
use CleaniqueCoders\KongAdminApi\Configuration;
use CleaniqueCoders\KongAdminApi\Connector;
use CleaniqueCoders\KongAdminApi\Enums\Endpoint;
use CleaniqueCoders\KongAdminApi\Enums\Plugin;
use CleaniqueCoders\KongAdminApi\Request;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

// Configuration setup for all tests
$configuration = new Configuration(
    base: 'http://127.0.0.1:8000',
    uri: 'admin-api',
    apiKey: 'test-api-key',
    keyName: 'api-key'
);

test('it can store a rate-limiting plugin for a consumer', function () use ($configuration) {
    $mockClient = new MockClient([
        MockResponse::make([
            'status' => ['code' => '201', 'phrase' => 'Created'],
            'data' => ['name' => 'rate-limiting', 'config' => ['minute' => 5]],
            'meta' => ['responded_at' => '2024-11-05 14:14:25'],
        ], 201),
    ]);

    $connector = new Connector($configuration);
    $connector->withMockClient($mockClient);
    $client = new Client($connector);

    $request = (new Request)
        ->plugin(Plugin::RATE_LIMITING, Endpoint::CONSUMERS, 'consumer-id')
        ->store(['config' => ['minute' => 5]]);

    $response = $client->send($request);

    expect($response->toArray())->toMatchArray([
        'status' => ['code' => '201', 'phrase' => 'Created'],
        'data' => ['name' => 'rate-limiting', 'config' => ['minute' => 5]],
        'meta' => ['responded_at' => '2024-11-05 14:14:25'],
    ]);
});

test('it can update a cors plugin for a route', function () use ($configuration) {
    $mockClient = new MockClient([
        MockResponse::make([
            'status' => ['code' => '200', 'phrase' => 'OK'],
            'data' => ['name' => 'cors', 'config' => ['origins' => ['*']]],
            'meta' => ['responded_at' => '2024-11-05 14:15:00'],
        ], 200),
    ]);

    $connector = new Connector($configuration);
    $connector->withMockClient($mockClient);
    $client = new Client($connector);

    $request = (new Request)
        ->plugin(Plugin::CORS, Endpoint::ROUTES, 'route-id', 'plugin-id')
        ->update('plugin-id', ['config' => ['origins' => ['*']]]);

    $response = $client->send($request);

    expect($response->toArray())->toMatchArray([
        'status' => ['code' => '200', 'phrase' => 'OK'],
        'data' => ['name' => 'cors', 'config' => ['origins' => ['*']]],
        'meta' => ['responded_at' => '2024-11-05 14:15:00'],
    ]);
});

test('it can get a jwt plugin for a service', function () use ($configuration) {
    $mockClient = new MockClient([
        MockResponse::make([
            'status' => ['code' => '200', 'phrase' => 'OK'],
            'data' => ['name' => 'jwt'],
            'meta' => ['responded_at' => '2024-11-05 14:16:00'],
        ], 200),
    ]);

    $connector = new Connector($configuration);
    $connector->withMockClient($mockClient);
    $client = new Client($connector);

    $request = (new Request)
        ->plugin(Plugin::JWT, Endpoint::SERVICES, 'service-id', 'plugin-id')
        ->get();

    $response = $client->send($request);

    expect($response->toArray())->toMatchArray([
        'status' => ['code' => '200', 'phrase' => 'OK'],
        'data' => ['name' => 'jwt'],
        'meta' => ['responded_at' => '2024-11-05 14:16:00'],
    ]);
});

test('it can delete an hmac-auth plugin from a service', function () use ($configuration) {
    $mockClient = new MockClient([
        MockResponse::make([
            'status' => ['code' => '204', 'phrase' => 'No Content'],
            'data' => [],
            'meta' => ['responded_at' => '2024-11-05 14:17:00'],
        ], 204),
    ]);

    $connector = new Connector($configuration);
    $connector->withMockClient($mockClient);
    $client = new Client($connector);

    $request = (new Request)
        ->plugin(Plugin::HMAC_AUTH, Endpoint::SERVICES, 'service-id', 'plugin-id')
        ->delete('plugin-id');

    $response = $client->send($request);

    expect($response->toArray())->toMatchArray([
        'status' => ['code' => '204', 'phrase' => 'No Content'],
        'data' => [],
        'meta' => ['responded_at' => '2024-11-05 14:17:00'],
    ]);
});
