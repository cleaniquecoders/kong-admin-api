<?php

namespace CleaniqueCoders\KongAdminApi;

use CleaniqueCoders\KongAdminApi\Contracts\Response;
use DateTimeInterface;

/**
 * Class ApiResponse
 *
 * Encapsulates the API response structure and data.
 */
class ApiResponse implements Response
{
    /**
     * The HTTP status code of the response.
     */
    private string $statusCode;

    /**
     * The HTTP status phrase of the response.
     */
    private string $statusPhrase;

    /**
     * The data payload from the API response.
     *
     * @var array<string, mixed>
     */
    private array $data;

    /**
     * The date and time when the response was processed.
     */
    private DateTimeInterface $respondedAt;

    /**
     * ApiResponse constructor.
     *
     * @param  string  $statusCode  The HTTP status code
     * @param  string  $statusPhrase  The HTTP status phrase
     * @param  array<string, mixed>  $data  The response data
     * @param  DateTimeInterface  $respondedAt  The timestamp when the response was processed
     */
    public function __construct(string $statusCode, string $statusPhrase, array $data, DateTimeInterface $respondedAt)
    {
        $this->statusCode = $statusCode;
        $this->statusPhrase = $statusPhrase;
        $this->data = $data;
        $this->respondedAt = $respondedAt;
    }

    /**
     * Get the HTTP status code.
     */
    public function getStatusCode(): string
    {
        return $this->statusCode;
    }

    /**
     * Get the HTTP status phrase.
     */
    public function getStatusPhrase(): string
    {
        return $this->statusPhrase;
    }

    /**
     * Get the response data.
     *
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Get the timestamp when the response was processed.
     */
    public function getRespondedAt(): DateTimeInterface
    {
        return $this->respondedAt;
    }

    /**
     * Convert the ApiResponse instance to an array.
     *
     * @return array<string, mixed> The response data in array format
     */
    public function toArray(): array
    {
        return [
            'status' => [
                'code' => $this->getStatusCode(),
                'phrase' => $this->getStatusPhrase(),
            ],
            'data' => $this->getData(),
            'meta' => [
                'responded_at' => $this->getRespondedAt()->format('Y-m-d H:i:s'),
            ],
        ];
    }
}
