<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50)->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('restrict');
            $table->foreignId('service_id')->constrained('services')->onDelete('restrict');
            $table->decimal('weight', 8, 2);
            $table->unsignedInteger('price_per_kg');
            $table->unsignedBigInteger('total_price');
            $table->date('entry_date');
            $table->date('estimated_completion');
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai', 'Sudah Diambil'])->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};