<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number', 20)->unique();    // PAY-2026-000001
            $table->char('ticket_code', 8)->unique();          // B9X21234
            $table->string('idempotency_key', 64)->unique();
            $table->foreignId('order_id')->constrained('orders');

            $table->decimal('amount', 12, 2);
            $table->string('payment_method', 30);              // cash, card, transfer
            $table->string('reference', 100)->nullable();       // Transaction reference
            $table->string('status', 20)->default('pending');  // pending -> completed -> refunded -> failed

            $table->foreignId('processed_by')->constrained('users');
            $table->timestamps();

            $table->index(['order_id', 'created_at']);
            $table->index(['status', 'created_at']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
