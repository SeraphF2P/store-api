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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('seller_name');
            $table->double('price');
            $table->enum('category', ['shoes', 'accessories', 'electronics', 'jewelrys', "men\'s clothing", "women\'s clothing"]);
            $table->double('rating')->default(0.00);
            $table->string('description');
            $table->foreignid('users_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
