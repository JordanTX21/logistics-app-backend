<?php

namespace Src\Shared\Services;

use Illuminate\Support\Str;

class TicketCodeGenerator
{
    /**
     * Generates an 8-character random alphanumeric code.
     * Ensures uppercase for readability.
     */
    public function generate(): string
    {
        return strtoupper(Str::random(8));
    }
}
