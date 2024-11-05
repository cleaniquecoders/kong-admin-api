<?php

use CleaniqueCoders\KongAdminApi\Client;
use CleaniqueCoders\KongAdminApi\Configuration;
use CleaniqueCoders\KongAdminApi\Connector;
use CleaniqueCoders\KongAdminApi\Enums\Endpoint;
use CleaniqueCoders\KongAdminApi\Request;
use CleaniqueCoders\KongAdminApi\Response;
use Saloon\Enums\Method;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

// Set up reusable configuration and connector
beforeEach(function () {
    $this->configuration = new Configuration(
        base: 'https://kong-admin.com',
        uri: 'api',
        apiKey: 'test-api-key',
        keyName: 'apikey'
    );

    $this->connector = new Connector($this->configuration);
});

it('initializes the Client with Connector', function () {
    $client = new Client($this->connector);

    expect($client)->toBeInstanceOf(Client::class);
});

it('sends an API request and processes the response', function () {
    $mockClient = new MockClient([
        MockResponse::make(['result' => 'success'], 200, [
            'Content-Type' => 'application/json',
            'apikey' => 'test-api-key',
        ]),
    ]);

    $this->connector->withMockClient($mockClient);

    $client = new Client($this->connector);

    $request = new Request;
    $request->setEndPoint(Endpoint::SERVICES);
    $request->get();

    $response = $client->send($request);

    expect($response)->toBeInstanceOf(Response::class)
        ->and($response->getStatusCode())->toBe('200')
        ->and($response->getStatusPhrase())->toBe('OK')
        ->and($response->getData())->toBe(['result' => 'success'])
        ->and($response->toArray())->toMatchArray([
            'status' => ['code' => '200', 'phrase' => 'OK'],
            'data' => ['result' => 'success'],
        ]);
});

it('sets and retrieves data in Request', function () {
    $request = new Request;
    $request->setMethod(Method::POST)
        ->setEndpoint(Endpoint::SERVICES)
        ->body()->set(['key' => 'value']);

    expect($request->getMethod())->toBe(Method::POST)
        ->and($request->getEndpoint())->toBe(Endpoint::SERVICES)
        ->and($request->body()->all())->toBe(['key' => 'value']);
});

it('initializes Response with correct data and converts to array', function () {
    $statusCode = '200';
    $statusPhrase = 'OK';
    $data = ['result' => 'success'];
    $respondedAt = new DateTime;

    $response = new Response($statusCode, $statusPhrase, $data, $respondedAt);

    expect($response->getStatusCode())->toBe($statusCode)
        ->and($response->getStatusPhrase())->toBe($statusPhrase)
        ->and($response->getData())->toBe($data)
        ->and($response->getRespondedAt())->toBeInstanceOf(DateTime::class)
        ->and($response->toArray())->toMatchArray([
            'status' => ['code' => '200', 'phrase' => 'OK'],
            'data' => $data,
            'meta' => [
                'responded_at' => $respondedAt->format('Y-m-d H:i:s'),
            ],
        ]);
});
