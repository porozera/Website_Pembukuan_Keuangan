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

            // Relasi
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Kolom stok
            $table->decimal('initial_stock', 15, 2); // Stok awal (qty)
            $table->decimal('final_stock', 15, 2); // Stok akhir (qty)
            $table->decimal('quantity_produced', 8, 2); // Jumlah barang diproduksi (qty)

            // Biaya produksi
            $table->decimal('production_cost', 15, 2); // Total biaya produksi
            $table->decimal('price_per_unit', 10, 2); // Harga produksi per unit

            // Penjualan
            $table->decimal('sales_revenue', 15, 2)->nullable(); // Pendapatan penjualan
            $table->decimal('sales_return', 15, 2)->default(0); // Retur penjualan
            $table->decimal('sales_discount', 15, 2)->default(0); // Diskon penjualan
            $table->decimal('sales_shipping_cost', 15, 2)->default(0); // Biaya pengiriman

            // Perhitungan
            $table->decimal('hpp', 15, 2)->nullable(); // Harga Pokok Penjualan
            $table->decimal('gross_profit', 15, 2)->nullable(); // Laba Kotor
            $table->decimal('recommended_price', 15, 2)->nullable(); // Harga rekomendasi
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
