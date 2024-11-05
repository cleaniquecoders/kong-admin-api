# A PHP package for seamless interaction with Kong Gateway's Admin API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cleaniquecoders/kong-admin-api.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/kong-admin-api) [![Tests](https://img.shields.io/github/actions/workflow/status/cleaniquecoders/kong-admin-api/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/cleaniquecoders/kong-admin-api/actions/workflows/run-tests.yml) [![Total Downloads](https://img.shields.io/packagist/dt/cleaniquecoders/kong-admin-api.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/kong-admin-api)

## Installation

You can install the package via Composer:

```bash
composer require cleaniquecoders/kong-admin-api
```

For contributing for development, refer [development](docs/development.md) documentation.

## Usage

Here's an example of how to configure and use the package to fetch a list of services from the Kong Admin API:

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

try {
    // Send a GET request to retrieve services
    $response = $client->send(
        (new Request)
            ->setEndPoint(Endpoint::SERVICES)
            ->get()
    );

    // Process the response
    print_r($response); // Or handle as needed

} catch (\Throwable $th) {
    // Handle exceptions
    throw $th;
}
```

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
