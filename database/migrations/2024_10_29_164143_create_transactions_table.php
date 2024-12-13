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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table ->date('date');
            $table ->string('transaction_type');
            $table ->string('debit');
            $table ->string('credit');
            $table ->decimal('amount', 15, 2);
            $table ->text('description');
            $table ->string('contact')->nullable();
            $table ->decimal('tax')->nullable();
            $table ->date('due_date')->nullable();
            $table ->decimal('interest_rate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
