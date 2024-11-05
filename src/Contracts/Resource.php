<?php

namespace CleaniqueCoders\KongAdminApi\Contracts;

interface Resource
{
    /**
     * Prepares a store request with POST method and data.
     *
     * @param  array<string, mixed>  $data  The data to store
     * @return $this
     */
    public function store(array $data): self;

    /**
     * Prepares an update request with PUT method, identifier, and data.
     *
     * @param  string  $identifier  The identifier for the resource to update
     * @param  array<string, mixed>  $data  The data for the update
     * @return $this
     */
    public function update(string $identifier, array $data): self;

    /**
     * Prepares a patch request with PATCH method, identifier, and data.
     *
     * @param  string  $identifier  The identifier for the resource to update
     * @param  array<string, mixed>  $data  The data for the update
     * @return $this
     */
    public function patch(string $identifier, array $data): self;

    /**
     * Prepares a delete request with DELETE method and identifier.
     *
     * @param  string  $identifier  The identifier for the resource to delete
     * @return $this
     */
    public function delete(string $identifier): self;

    /**
     * Prepares a get request with GET method and optional identifier.
     *
     * @param  string|null  $identifier  The identifier for the resource to retrieve
     * @return $this
     */
    public function get(?string $identifier = null): self;
}
