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
        Schema::table('tenant_data', function (Blueprint $table) {
            $table->string('clientid', 100)->change(); // Change column type to VARCHAR(100)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenant_data', function (Blueprint $table) {
            $table->integer('clientid')->change(); // Revert back to integer (example)
        });
    }
};
