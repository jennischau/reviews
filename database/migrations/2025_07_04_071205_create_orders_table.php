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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('code'); // Mã đơn
            $table->text('map_link')->nullable(); // Link map
            $table->string('status')->default('pending'); // Trạng thái approved, in_progress, reported, completed, failed
            $table->text('note')->nullable(); // Ghi chú
            $table->text('content')->nullable(); // Nội dung khi hoàn thành
            $table->string('image')->nullable(); // Ảnh review
            $table->text('drive_link')->nullable();
            $table->decimal('price', 12)->default(0); // Đơn giá
            $table->string('time')->nullable();
            $table->timestamp('completed_at')->nullable(); // Ngày hoàn thành
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
