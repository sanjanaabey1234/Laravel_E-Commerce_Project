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
        Schema::table('users', function (Blueprint $table) {
            // Rename the column from 'district' to 'district_id'
            $table->renameColumn('district', 'district_id');

            // Change the column type to bigint
            $table->bigInteger('district_id')->unsigned()->change();

            // Add foreign key constraint
            $table->foreign('district_id')->references('district_id')->on('districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['district_id']);

            // Change the column type back to string
            $table->string('district')->change();

            // Rename the column back to 'district'
            $table->renameColumn('district_id', 'district');
        });
    }
};
