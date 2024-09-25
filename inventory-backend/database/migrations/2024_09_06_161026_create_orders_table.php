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
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('pay_amount')->default(0.0);
            $table->decimal('due_amount')->default(0.0);
            $table->decimal('subtotal')->default(0.0);
            $table->decimal('discount')->default(0.0);
            $table->decimal('total')->default(0.0);
            $table->string('transaction_number')->nullable();
            $table->string('payment_method')->default('cash');
            $table->timestamps();
            $table->softDeletes();
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
