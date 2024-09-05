<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hand_made_products', function (Blueprint $table) {
            $table->id('handmadeproduct_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('seller_id');
            $table->string('image_path');
            $table->string('handmadeproduct_name', 200);
            $table->text('description')->nullable();
            $table->integer('stock_quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('Amount', 10, 2);
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('seller_id')->references('seller_id')->on('sellers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hand_made_products');
    }
};
