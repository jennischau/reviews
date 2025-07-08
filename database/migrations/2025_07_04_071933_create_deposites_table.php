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
        Schema::create('deposites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_code');
            $table->decimal('balance_before', 12, 2);
            $table->decimal('amount', 12, 2); // Số tiền nạp
            $table->decimal('balance_after', 12, 2);
            $table->timestamp('paid_at')->nullable();
            $table->string('status')->default('pending'); // pending, success, failed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
