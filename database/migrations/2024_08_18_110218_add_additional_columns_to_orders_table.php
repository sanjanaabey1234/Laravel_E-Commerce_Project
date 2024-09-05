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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('first_name', 255)->after('shipping_address');
            $table->string('last_name', 255)->after('first_name');
            $table->string('address', 255)->after('last_name');
            $table->string('town_city', 255)->after('address');
            $table->string('postcode_zip', 255)->after('town_city');
            $table->string('mobile', 255)->after('postcode_zip');
            $table->string('email_address', 255)->after('mobile');
            $table->text('order_notes')->nullable()->after('email_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'address', 'town_city', 'postcode_zip', 'mobile', 'email_address', 'order_notes']);
        });
    }
};
