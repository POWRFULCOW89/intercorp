<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->string('transaction_id');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['credit_card', 'paypal', 'cash'])->default('credit_card');
            $table->enum('status', ['created', 'pending', 'paid', 'canceled', 'refunded'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
