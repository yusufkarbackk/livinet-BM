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
        Schema::create('tenant_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clientid');
            $table->string('firstname');
            $table->string('lastname');
            $table->integer('serviceid');
            $table->string('name');
            $table->integer('amount');
            $table->string('location')->nullable();
            $table->string('status');
            $table->date('termination_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_data');
    }
};
