<?php

use CleaniqueCoders\KongAdminApi\Config;

it('can initialize Config with url and key', function () {
    $url = 'http://localhost:8001';
    $key = 'test-api-key';

    $config = new Config($url, $key);

    expect($config->getUrl())->toBe($url);
    expect($config->getKey())->toBe($key);
});

it('throws an error when no parameters are provided', function () {
    new Config();
})->throws(TypeError::class);
