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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // ── Dual identification ──────────────────────────
            $table->string('ticket_number', 20)->unique();    // ORD-2026-000001
            $table->char('ticket_code', 8)->unique();          // A7F3Q8X4

            // ── Idempotency ─────────────────────────────────
            $table->string('idempotency_key', 64)->unique();

            // ── Business data ───────────────────────────────
            $table->foreignId('sender_id')->constrained('persons');
            $table->foreignId('receiver_id')->constrained('persons');
            $table->foreignId('origin_agency_id')->constrained('agencies');
            $table->foreignId('destination_agency_id')->constrained('agencies');
            $table->text('description')->nullable();
            $table->decimal('weight_kg', 8, 3);
            $table->decimal('volume_m3', 8, 4)->nullable();
            $table->decimal('declared_value', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2);

            // ── Status ──────────────────────────────────────
            $table->string('status', 20)->default('pending'); // pending -> confirmed -> in_transit -> delivered -> cancelled

            // ── Audit ───────────────────────────────────────
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();

            // ── Indexes for high-scale queries ──────────────
            $table->index('ticket_code');                             // Fast lookup
            $table->index(['status', 'created_at']);                  // Filtered listing
            $table->index(['origin_agency_id', 'created_at']);        // Agency reports
            $table->index(['destination_agency_id', 'created_at']);   // Agency reports
            $table->index(['sender_id', 'created_at']);               // Customer history
            $table->index('created_at');                              // Partition key candidate
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
