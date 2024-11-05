# A PHP package for seamless interaction with Kong Gateway's Admin API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cleaniquecoders/kong-admin-api.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/kong-admin-api) [![Tests](https://img.shields.io/github/actions/workflow/status/cleaniquecoders/kong-admin-api/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/cleaniquecoders/kong-admin-api/actions/workflows/run-tests.yml) [![Total Downloads](https://img.shields.io/packagist/dt/cleaniquecoders/kong-admin-api.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/kong-admin-api)

## Installation

You can install the package via Composer:

```bash
composer require cleaniquecoders/kong-admin-api
```

## Usage

This package provides a simple and flexible way to interact with Kong Gateway's Admin API.

### Basic Setup

Instantiate the Kong Admin Client:

```php
use CleaniqueCoders\KongAdminApi\KongAdminClient;

$client = new KongAdminClient('http://localhost:8001'); // Replace with your Kong Admin URL
```

### Example: Creating a Service

```php
$response = $client->services()->create([
    'name' => 'example-service',
    'url' => 'http://example.com',
]);

if ($response->isSuccessful()) {
    echo "Service created successfully!";
} else {
    echo "Failed to create service: " . $response->getError();
}
```

### Available Methods

- **Services**: Manage and configure services.
- **Routes**: Define routes for services.
- **Consumers**: Manage consumers for your services.
- **Plugins**: Attach plugins to services, routes, or consumers.
- **Certificates**: Handle SSL certificates.

Please refer to the official Kong Gateway documentation for detailed options and parameters for each endpoint.

## Testing

To run tests:

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/cleaniquecoders/kong-admin-api/blob/main/CONTRIBUTING.md) for details on how to contribute.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Nasrul Hazim Bin Mohamad](https://github.com/nasrulhazim)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
