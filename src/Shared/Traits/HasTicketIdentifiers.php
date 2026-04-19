<?php

namespace Src\Shared\Traits;

use Src\Shared\Services\TicketCodeGenerator;
use Src\Shared\Services\TicketNumberGenerator;

trait HasTicketIdentifiers
{
    /**
     * Automatically generate missing identifiers on model creation.
     */
    protected static function bootHasTicketIdentifiers()
    {
        static::creating(function ($model) {
            if (empty($model->ticket_code)) {
                $generator = app(TicketCodeGenerator::class);
                $model->ticket_code = $generator->generate();
            }

            if (empty($model->ticket_number)) {
                $generator = app(TicketNumberGenerator::class);
                $model->ticket_number = $generator->generate(
                    method_exists($model, 'getTicketPrefix') ? $model->getTicketPrefix() : 'SYS'
                );
            }
        });
    }
}
