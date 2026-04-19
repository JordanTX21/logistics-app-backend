<?php

namespace Src\Customer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = [
        'document_type',
        'document_number',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    /**
     * Helper to get full name automatically.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
