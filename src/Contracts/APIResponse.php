<?php

namespace CleaniqueCoders\KongAdminApi;

/**
 * Interface APIResponse
 *
 * Defines the structure for handling API responses from the Kong Admin API.
 */
interface APIResponse
{
    /**
     * Process the API response and return it as an array.
     *
     * @param  mixed  $response  The raw response from the API
     * @return array<string, mixed> Processed response data with string keys and mixed values
     */
    public function response($response): array;

    /**
     * Get the status code from the API response.
     *
     * @return string The status code as a string
     */
    public function statusCode(): string;

    /**
     * Get the status phrase from the API response.
     *
     * @return string The status phrase as a string
     */
    public function statusPhrase(): string;
}
