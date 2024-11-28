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
        if (!Schema::hasTable('vouchers')) {
            Schema::create('vouchers', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->decimal('discount_amount', 8, 2);
                $table->enum('discount_type', ['fixed', 'percentage']);
                $table->decimal('discount_percentage', 5, 2)->nullable();
                $table->date('valid_from');
                $table->date('valid_until');
                $table->integer('usage_limit')->nullable();
                $table->integer('times_used')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
