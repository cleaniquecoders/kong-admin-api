<?php

namespace CleaniqueCoders\KongAdminApi;

use Saloon\Http\Connector as Base;

class Connector extends Base
{
    public function __construct(protected Configuration $configuration) {}

    public function resolveBaseUrl(): string
    {
        return $this->configuration->getUrl();
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}
