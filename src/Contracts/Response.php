<?php

namespace CleaniqueCoders\KongAdminApi\Contracts;

use DateTimeInterface;

/**
 * Interface Response
 *
 * Defines the contract for API response objects, specifying the structure and methods
 * required for interacting with the response data, such as status, data, and timestamps.
 */
interface Response
{
    /**
     * Get the HTTP status code of the response.
     */
    public function getStatusCode(): string;

    /**
     * Get the HTTP status phrase of the response.
     */
    public function getStatusPhrase(): string;

    /**
     * Get the data payload from the API response.
     *
     * @return array<string, mixed>
     */
    public function getData(): array;

    /**
     * Get the timestamp when the response was processed.
     */
    public function getRespondedAt(): DateTimeInterface;

    /**
     * Convert the response data to an array format.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
