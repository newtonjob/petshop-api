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
            $table->uuid();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('order_status_id')->constrained();
            $table->foreignId('payment_id')->nullable()->constrained();
            $table->string('address')->nullable();
            $table->json('address')->nullable();
            $table->float('delivery_fee')->nullable();
            $table->float('amount', 12);
            $table->timestamp('shipped_at')->nullable();
            $table->timestamps();
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
