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
        Schema::create('receivables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->decimal('amount', 15, 2); // Jumlah Piutang
            $table->decimal('interest_rate', 5, 2)->nullable(); // Tingkat Bunga (Opsional)
            $table->date('due_date'); // Tanggal Jatuh Tempo
            $table->enum('status', ['Lunas', 'Belum Lunas'])->default('Belum Lunas'); // Status Pembayaran
            $table->text('description')->nullable(); // Deskripsi (Opsional)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receivables');
    }
};
