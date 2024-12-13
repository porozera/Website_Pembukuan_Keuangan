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
        Schema::create('debts_receivables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            $table ->string('type');
            $table->bigInteger('invoice');
            $table ->decimal('amount', 15, 2);
            $table ->decimal('paid_amount', 15, 2)->default(0);
            $table ->decimal('rest_amount', 15, 2);
            $table ->decimal('interest_rate', 15, 2)->nullable();
            $table ->date('date');
            $table ->date('due_date')->nullable();
            $table ->string('status');
            $table ->text('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts_receivables');
    }
};
