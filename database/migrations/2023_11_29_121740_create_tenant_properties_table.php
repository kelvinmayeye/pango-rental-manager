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
        Schema::create('tenant_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained();
            $table->foreignId('property_id')->constrained();
            $table->boolean('is_active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_properties');
    }
};
