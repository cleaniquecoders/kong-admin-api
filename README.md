# A PHP package for seamless interaction with Kong Gateway's Admin API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cleaniquecoders/kong-admin-api.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/kong-admin-api) [![Tests](https://img.shields.io/github/actions/workflow/status/cleaniquecoders/kong-admin-api/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/cleaniquecoders/kong-admin-api/actions/workflows/run-tests.yml) [![Total Downloads](https://img.shields.io/packagist/dt/cleaniquecoders/kong-admin-api.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/kong-admin-api)

## Installation

You can install the package via Composer:

```bash
composer require cleaniquecoders/kong-admin-api
```

## Usage

### Setup

1. **Install the Package** (if not already installed):

   ```bash
   composer require cleaniquecoders/kong-admin-api
   ```

2. **Configure the `Connector`**:
   Set up the configuration details such as base URL, URI, API key, and any additional headers.

   ```php
   use CleaniqueCoders\KongAdminApi\Configuration;
   use CleaniqueCoders\KongAdminApi\Connector;

   $configuration = new Configuration(
       base: 'https://your-kong-admin-url.com',
       uri: 'api',
       apiKey: 'your-api-key',
       keyName: 'apikey'
   );

   $connector = new Connector($configuration);
   ```

### Interacting with the API

The `ApiClient` class allows you to interact with the API for common CRUD operations and manage resources.

#### Initialize the Client

```php
use CleaniqueCoders\KongAdminApi\Api\ApiClient;

$client = new ApiClient($connector);
$client->setPath('resources'); // Set the base path for the resource endpoint
```

#### CRUD Operations

1. **Retrieve All Resources (Index)**

   ```php
   $resources = $client->index();
   print_r($resources);
   ```

2. **Show a Specific Resource**

   ```php
   $resourceId = 'example-id';
   $resource = $client->show($resourceId);
   print_r($resource);
   ```

3. **Create a New Resource**

   ```php
   $data = [
       'name' => 'New Resource',
       'description' => 'Description for the new resource'
   ];

   $createdResource = $client->store($data);
   print_r($createdResource);
   ```

4. **Update an Existing Resource**

   ```php
   $resourceId = 'example-id';
   $updateData = [
       'name' => 'Updated Resource',
       'description' => 'Updated description'
   ];

   $updatedResource = $client->update($resourceId, $updateData);
   print_r($updatedResource);
   ```

5. **Delete a Resource**

   ```php
   $resourceId = 'example-id';
   $deleteResult = $client->delete($resourceId);
   print_r($deleteResult);
   ```

### Handling Responses

Each CRUD method returns an `ApiResponse` object, which contains structured data about the response, including status code, message, and the actual data.

For example, you can retrieve status information and data like so:

```php
$response = $client->show('example-id');

echo "Status Code: " . $response['status']['code'] . PHP_EOL;
echo "Status Phrase: " . $response['status']['phrase'] . PHP_EOL;
print_r($response['data']);
```

### Custom Requests with `ApiRequest`

You can create a custom request using the `ApiRequest` class, allowing you to specify HTTP methods, endpoints, and payloads.

```php
use CleaniqueCoders\KongAdminApi\Api\ApiRequest;
use Saloon\Enums\Method;

$request = new ApiRequest();
$request->setMethod(Method::POST)
        ->setEndpoint('custom-endpoint')
        ->body()->set([
            'param1' => 'value1',
            'param2' => 'value2',
        ]);

$response = $connector->send($request);
print_r($response->json());
```

### Error Handling

Wrap your requests in `try-catch` blocks to handle any exceptions that may occur:

```php
try {
    $resource = $client->show('invalid-id');
    print_r($resource);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

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
