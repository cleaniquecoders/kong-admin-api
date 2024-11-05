<?php

use CleaniqueCoders\KongAdminApi\Configuration;

it('can initialize Configuration with url, key, and key_name', function () {
    $url = 'http://localhost:8001';
    $key = 'test-api-key';
    $keyName = 'custom-api-key';

    $config = new Configuration($url, $key, $keyName);

    expect($config->getUrl())->toBe($url);
    expect($config->getKey())->toBe($key);
    expect($config->getKeyName())->toBe($keyName);
});

it('uses default key_name if not provided', function () {
    $url = 'http://localhost:8001';
    $key = 'test-api-key';

    $config = new Configuration($url, $key);

    expect($config->getUrl())->toBe($url);
    expect($config->getKey())->toBe($key);
    expect($config->getKeyName())->toBe('apikey'); // Default key name
});

it('can initialize Configuration with url and key', function () {
    $url = 'http://localhost:8001';
    $key = 'test-api-key';

    $config = new Configuration($url, $key);

    expect($config->getUrl())->toBe($url);
    expect($config->getKey())->toBe($key);
});

it('throws an error when no parameters are provided', function () {
    new Configuration;
})->throws(TypeError::class);
