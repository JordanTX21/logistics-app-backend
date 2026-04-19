<?php

namespace Src\Logistics\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Logistics\Order\Models\Order;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'ticket_code',
        'idempotency_key',
        'order_id',
        'amount',
        'payment_method',
        'reference',
        'status',
        'processed_by',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
