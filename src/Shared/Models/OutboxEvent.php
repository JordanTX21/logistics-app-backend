<?php

namespace Src\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutboxEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type',
        'payload',
        'status',
        'attempts',
        'error',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
        ];
    }
}
