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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->decimal('total_sales', 8, 2);
            $table->decimal('total_hpp', 8, 2);
            $table->decimal('total_debt', 8, 2);
            $table->decimal('total_receivables', 8, 2);
            $table->decimal('net_profit', 8, 2);
            $table->date('report_date');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
