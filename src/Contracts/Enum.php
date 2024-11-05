<?php

namespace CleaniqueCoders\KongAdminApi\Contracts;

interface Enum
{
    /**
     * Get the label for the enum case.
     */
    public function label(): string;

    /**
     * Get the description for the enum case.
     */
    public function description(): string;
}
