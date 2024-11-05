# A PHP package for seamless interaction with Kong Gateway's Admin API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cleaniquecoders/kong-admin-api.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/kong-admin-api) [![Tests](https://img.shields.io/github/actions/workflow/status/cleaniquecoders/kong-admin-api/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/cleaniquecoders/kong-admin-api/actions/workflows/run-tests.yml) [![Total Downloads](https://img.shields.io/packagist/dt/cleaniquecoders/kong-admin-api.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/kong-admin-api)

## Installation

You can install the package via Composer:

```bash
composer require cleaniquecoders/kong-admin-api
```

For contributing for development, refer [development](docs/development.md) documentation.

## Usage

Here are examples of using `store`, `update`, `delete`, and `get` requests.

```php
use CleaniqueCoders\KongAdminApi\Client;
use CleaniqueCoders\KongAdminApi\Configuration;
use CleaniqueCoders\KongAdminApi\Connector;
use CleaniqueCoders\KongAdminApi\Enums\Endpoint;
use CleaniqueCoders\KongAdminApi\Request;

// Initialize configuration with Kong Admin details
$configuration = new Configuration(
    base: 'http://127.0.0.1:8000',
    uri: 'admin-api',
    apiKey: 'your-api-key',
    keyName: 'api-key'
);

// Create a connector and client
$connector = new Connector($configuration);
$client = new Client($connector);

// Example: Store a new service
try {
    $response = $client->send(
        (new Request)
            ->setEndPoint(Endpoint::SERVICES)
            ->store([
                'name' => 'example-service',
                'url' => 'http://example.com'
            ])
    );

    print_r($response); // Handle the response as needed

} catch (\Throwable $th) {
    throw $th;
}

// Example: Update an existing service
try {
    $response = $client->send(
        (new Request)
            ->setEndPoint(Endpoint::SERVICES)
            ->update('example-service', [
                'url' => 'http://new-example.com'
            ])
    );

    print_r($response); // Handle the response as needed

} catch (\Throwable $th) {
    throw $th;
}

// Example: Delete a service
try {
    $response = $client->send(
        (new Request)
            ->setEndPoint(Endpoint::SERVICES)
            ->delete('example-service')
    );

    print_r($response); // Handle the response as needed

} catch (\Throwable $th) {
    throw $th;
}

// Example: Get a specific service
try {
    $response = $client->send(
        (new Request)
            ->setEndPoint(Endpoint::SERVICES)
            ->get('example-service')
    );

    print_r($response); // Handle the response as needed

} catch (\Throwable $th) {
    throw $th;
}

// Example: Get a list of all services
try {
    $response = $client->send(
        (new Request)
            ->setEndPoint(Endpoint::SERVICES)
            ->get()
    );

    print_r($response); // Handle the response as needed

} catch (\Throwable $th) {
    throw $th;
}
```

### Explanation

1. **Store**: Creates a new service by setting the endpoint to `SERVICES` and calling `store()` with the service data.
2. **Update**: Updates an existing service (specified by `identifier`, e.g., `'example-service'`) using the `update()` method with new data.
3. **Delete**: Deletes a service specified by the `identifier`.
4. **Get (Single Service)**: Retrieves details for a single service by passing the `identifier`.
5. **Get (All Services)**: Retrieves a list of all services without specifying an identifier.

Each example includes error handling to capture and manage exceptions.

## References

For more details on available endpoints, parameters, and usage of the Kong Admin API, please refer to the [Kong Admin API documentation](https://docs.konghq.com/gateway/latest/admin-api/).

The [`Endpoint`](src/Enums/Endpoint.php) enum in this package reflects the endpoints defined in the OpenAPI specification provided by Kong.

## Testing

To run tests:

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details on how to contribute.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Nasrul Hazim Bin Mohamad](https://github.com/nasrulhazim)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
