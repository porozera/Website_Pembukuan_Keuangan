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
        Schema::create('hppcalculations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->decimal('initial_stock', 8, 2);
            $table->decimal('final_stock', 8, 2);
            $table->decimal('purchase_amount', 8, 2);
            $table->decimal('shipping_cost', 8, 2);
            $table->decimal('purchase_return', 8, 2);
            $table->decimal('recommended_price', 8, 2);
            $table->decimal('purchase_discount', 8, 2);
            $table->decimal('sales_revenue', 8, 2);
            $table->decimal('sales_return', 8, 2);
            $table->decimal('sales_discount', 8, 2);
            $table->decimal('sales_shipping_cost', 8, 2);
            $table->decimal('hpp', 8, 2);
            $table->decimal('gross_profit', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hppcalculations');
    }
};
