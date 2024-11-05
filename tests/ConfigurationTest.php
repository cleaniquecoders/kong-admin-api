<?php

use CleaniqueCoders\KongAdminApi\Configuration;

it('can initialize Configuration with all parameters', function () {
    $base = 'http://localhost';
    $uri = '/admin';
    $apiKey = 'test-api-key';
    $keyName = 'custom-api-key';
    $headers = [
        'Content-Type' => 'application/x-www-form-urlencoded',
        'Accept' => 'application/json',
    ];
    $verify = true;

    $config = new Configuration($base, $uri, $apiKey, $keyName, $headers, $verify);

    expect($config->getBase())->toBe($base);
    expect($config->getUri())->toBe($uri);
    expect($config->getApiKey())->toBe($apiKey);
    expect($config->getKeyName())->toBe($keyName);
    expect($config->getHeaders())->toBe($headers);
    expect($config->shouldVerify())->toBeTrue();
    expect($config->getUrl())->toBe('http://localhost/admin');
});

it('uses default values for keyName, headers, and verify if not provided', function () {
    $base = 'http://localhost';
    $uri = '/admin';
    $apiKey = 'test-api-key';

    $config = new Configuration($base, $uri, $apiKey);

    expect($config->getBase())->toBe($base);
    expect($config->getUri())->toBe($uri);
    expect($config->getApiKey())->toBe($apiKey);
    expect($config->getKeyName())->toBe('apikey'); // Default key name
    expect($config->getHeaders())->toBe([
        'Content-Type' => 'application/x-www-form-urlencoded',
        'Accept' => 'application/json',
    ]); // Default headers
    expect($config->shouldVerify())->toBeFalse(); // Default verify
    expect($config->getUrl())->toBe('http://localhost/admin'); // URL combination
});

it('correctly combines base and uri in getUrl', function () {
    $config = new Configuration('http://localhost/', '/admin', 'test-api-key');
    expect($config->getUrl())->toBe('http://localhost/admin');
});

it('throws an error when required parameters are missing', function () {
    new Configuration;
})->throws(TypeError::class);
