<?php

namespace Src\Customer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_id',
        'business_name',
        'trade_name',
        'address',
        'contact_email',
        'contact_phone',
    ];
}
