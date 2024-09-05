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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id('delivery_id'); // Primary key with auto increment
            $table->unsignedBigInteger('order_id'); // Foreign key referencing Orders table
            $table->unsignedBigInteger('driver_id'); // Foreign key referencing Users table
            $table->enum('delivery_status', ['Pending', 'In Transit', 'Delivered', 'Cancelled']); // Delivery status field
            $table->date('delivery_date')->nullable(true);
            $table->timestamps(); // Created at timestamp

            // Set up the foreign key constraints
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
