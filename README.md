# A PHP package for seamless interaction with Kong Gateway's Admin API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cleaniquecoders/kong-admin-api.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/kong-admin-api) [![Tests](https://img.shields.io/github/actions/workflow/status/cleaniquecoders/kong-admin-api/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/cleaniquecoders/kong-admin-api/actions/workflows/run-tests.yml) [![Total Downloads](https://img.shields.io/packagist/dt/cleaniquecoders/kong-admin-api.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/kong-admin-api)

## Installation

You can install the package via Composer:

```bash
composer require cleaniquecoders/kong-admin-api
```

For contributing for development, refer [development](docs/development.md) documentation.

## Usage

Here are examples of using this package:

### Initialize Configuration

```php
use CleaniqueCoders\KongAdminApi\Configuration;

$configuration = new Configuration(
    base: 'http://127.0.0.1:8000',
    uri: 'admin-api',
    apiKey: 'your-api-key',
    keyName: 'api-key'
);
```

### Create Connector and Client

```php
use CleaniqueCoders\KongAdminApi\Client;
use CleaniqueCoders\KongAdminApi\Connector;

$connector = new Connector($configuration);
$client = new Client($connector);
```

### Example: Store a New Service

Stores a new service with the specified name and URL.

```php
use CleaniqueCoders\KongAdminApi\Enums\Endpoint;
use CleaniqueCoders\KongAdminApi\Request;

$response = $client->send(
    (new Request)
        ->setEndPoint(Endpoint::SERVICES)
        ->store([
            'name' => 'example-service',
            'url' => 'http://example.com'
        ])
);

print_r($response);
```

### Example: Update an Existing Service

Updates an existing service (specified by `identifier`) with new data.

```php
$response = $client->send(
    (new Request)
        ->setEndPoint(Endpoint::SERVICES)
        ->update('example-service', [
            'url' => 'http://new-example.com'
        ])
);

print_r($response);
```

### Example: Delete a Service

Deletes a service specified by the `identifier`.

```php
$response = $client->send(
    (new Request)
        ->setEndPoint(Endpoint::SERVICES)
        ->delete('example-service')
);

print_r($response);
```

### Example: Get a Specific Service

Retrieves details for a single service by passing the `identifier`.

```php
$response = $client->send(
    (new Request)
        ->setEndPoint(Endpoint::SERVICES)
        ->get('example-service')
);

print_r($response);
```

### Example: Get a List of All Services

Retrieves a list of all services without specifying an identifier.

```php
$response = $client->send(
    (new Request)
        ->setEndPoint(Endpoint::SERVICES)
        ->get()
);

print_r($response);
```

### Example: Add a Rate-Limiting Plugin to a Consumer

Associates a rate-limiting plugin with a specific consumer, configuring the rate limit to 5 requests per minute.

```php
use CleaniqueCoders\KongAdminApi\Enums\Plugin;

$response = $client->send(
    (new Request)
        ->plugin(Plugin::RATE_LIMITING, Endpoint::CONSUMERS, 'consumer-id')
        ->store(['config' => ['minute' => 5]])
);

print_r($response);
```

### Example: Update a CORS Plugin for a Route

Updates an existing CORS plugin associated with a specific route, allowing all origins.

```php
$response = $client->send(
    (new Request)
        ->plugin(Plugin::CORS, Endpoint::ROUTES, 'route-id', 'plugin-id')
        ->update('plugin-id', ['config' => ['origins' => ['*']]])
);

print_r($response);
```

### Example: Get a JWT Plugin for a Service

Retrieves details of a JWT plugin associated with a specific service.

```php
$response = $client->send(
    (new Request)
        ->plugin(Plugin::JWT, Endpoint::SERVICES, 'service-id', 'plugin-id')
        ->get()
);

print_r($response);
```

### Example: Delete an HMAC Authentication Plugin from a Service

Deletes an HMAC authentication plugin associated with a specific service.

```php
$response = $client->send(
    (new Request)
        ->plugin(Plugin::HMAC_AUTH, Endpoint::SERVICES, 'service-id', 'plugin-id')
        ->delete('plugin-id')
);

print_r($response);
```

## References

For more details on available endpoints, parameters, and usage of the Kong Admin API, please refer to the [Kong Admin API documentation](https://docs.konghq.com/gateway/latest/admin-api/).

To explore the plugins available for free and open-source use, visit the [Kong Hub Plugins page](https://docs.konghq.com/hub/?tier=free).

The [`Endpoint`](src/Enums/Endpoint.php) enum in this package reflects the endpoints defined in the OpenAPI specification provided by Kong.

Certainly! Here’s the list of free and open-source plugins available in Kong's free tier, as per the Kong Hub documentation:

### List of Free Tier Plugins for Kong

| Plugin Identifier           | Endpoint              | Label                    | Description                                                                                  |
|-----------------------------|-----------------------|--------------------------|----------------------------------------------------------------------------------------------|
| `acl`                       | `acls`                | ACL                      | Control access to services and routes by whitelisting or blacklisting consumers.             |
| `bot-detection`             | `bot-detection`       | Bot Detection            | Identify and block bot traffic based on various techniques and algorithms.                   |
| `cors`                      | `cors`                | CORS                     | Enable Cross-Origin Resource Sharing (CORS) on a service or route.                           |
| `ip-restriction`            | `ip-restriction`      | IP Restriction           | Allow or deny access based on the client's IP address.                                       |
| `jwt`                       | `jwt`                 | JWT                      | Validate JSON Web Tokens (JWT) for authentication purposes.                                  |
| `key-auth`                  | `key-auth`            | Key Authentication       | Authenticate users using an API key that consumers include in their requests.                |
| `ldap-auth`                 | `ldap-auth`           | LDAP Authentication      | Authenticate users against an LDAP server.                                                   |
| `oauth2`                    | `oauth2`              | OAuth 2.0                | Add OAuth 2.0 authentication to protect your APIs.                                           |
| `rate-limiting`             | `rate-limiting`       | Rate Limiting            | Limit the number of requests a user can make to an API within a defined period.              |
| `request-size-limiting`     | `request-size-limiting` | Request Size Limiting   | Limit the size of client request bodies.                                                     |
| `request-termination`       | `request-termination` | Request Termination      | Terminate incoming requests based on certain criteria, such as status code or message.       |
| `response-ratelimiting`     | `response-ratelimiting` | Response Rate Limiting | Control response rates based on defined criteria.                                            |
| `session`                   | `session`             | Session Management       | Manage sessions and store session data across multiple requests.                             |
| `basic-auth`                | `basic-auth`          | Basic Authentication     | Provide basic authentication (username and password) for consumers.                          |
| `hmac-auth`                 | `hmac-auth`           | HMAC Authentication      | Authenticate users using HMAC signature-based authentication.                                |
| `datadog`                   | `datadog`             | Datadog                  | Send request metrics to Datadog for monitoring and alerting.                                 |
| `prometheus`                | `prometheus`          | Prometheus               | Expose metrics in a format that Prometheus can scrape for monitoring.                        |
| `statsd`                    | `statsd`              | StatsD                   | Send request metrics to a StatsD server for monitoring.                                      |
| `tcp-log`                   | `tcp-log`             | TCP Log                  | Log request data to a TCP server for monitoring or analysis.                                 |
| `udp-log`                   | `udp-log`             | UDP Log                  | Log request data to a UDP server for monitoring or analysis.                                 |
| `file-log`                  | `file-log`            | File Log                 | Log request data to a file for later review.                                                 |
| `http-log`                  | `http-log`            | HTTP Log                 | Log request data to an HTTP endpoint for monitoring or analysis.                             |
| `syslog`                    | `syslog`              | Syslog                   | Log request data to the Syslog service for centralized logging.                              |

This list includes each plugin’s **identifier**, **endpoint**, **label**, and a brief **description** of its functionality. These plugins can be used to add various features such as rate limiting, authentication, logging, and monitoring to Kong APIs in the free and open-source tier.

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
