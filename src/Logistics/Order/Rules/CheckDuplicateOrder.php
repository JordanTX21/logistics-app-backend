<?php

namespace Src\Logistics\Order\Rules;

use Closure;
use Src\Logistics\Order\Models\Order;
use Src\Shared\Exceptions\BusinessRuleException;

class CheckDuplicateOrder
{
    public function handle(array $payload, Closure $next): mixed
    {
        $exists = Order::where('idempotency_key', $payload['idempotency_key'])->exists();

        if ($exists) {
            throw new BusinessRuleException(
                message: 'An order with this idempotency key already exists.',
                errorCode: 'DUPLICATE_ORDER',
                statusCode: 409,
            );
        }

        return $next($payload);
    }
}
