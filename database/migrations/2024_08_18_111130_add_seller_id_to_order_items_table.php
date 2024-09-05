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
        Schema::table('order_items', function (Blueprint $table) {
            // Add the seller_id column
            $table->unsignedBigInteger('seller_id')->after('product_id');

            // Add the foreign key constraints
            $table->foreign('seller_id')->references('seller_id')->on('sellers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Drop the foreign key and the column
            $table->dropForeign(['seller_id']);
            $table->dropColumn('seller_id');
        });
    }
};
